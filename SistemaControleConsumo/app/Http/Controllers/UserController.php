<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use View;
use App\User;
use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = Auth()->user()->access_level == 0 ? User::where('access_level', '<>', 0)->get() : User::where('predio_id', Auth()->user()->predio_id)->get();
    
        return View::make('admin.cadastros.usuario.index')->with('usuarios', $usuarios);
    }

    public function create()
    {
        $usuario = new User;

        $buildings = Building::all();
        return View::make('admin.cadastros.usuario.cadastro', compact('usuario', 'buildings'));
    }

    public function store(Request $request)
    {

        /* Valida o Email */
        $request->validate([
            'email'  => 'bail|unique:users',
        ]);

       $usuario = new User();

       $usuario = $usuario->create([
            'name'              => $request['nome'],
            'email'             => $request['email'],
            'telefone1'         => $request['telefone1'],
            'telefone2'         => $request['telefone2'],
            'num_apartamento'   => $request['num_apartamento'],
            'qnt_pessoas'       => $request['qnt_pessoas'],
            'password'          => bcrypt($request['senha']),
            'predio_id'         => Auth()->user()->predio_id,
            'access_level'      => $request['access_level'],
        ]);

        \Session::flash('flash_message_success', 'Usuário <strong>'. $usuario->name . '</strong> cadastrado com sucesso!');

        return Redirect::to('usuarios');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        if ((Auth()->user()->access_level != '0' && Auth()->user()->predio_id != $usuario->predio_id)) {
            \Session::flash('flash_message_error', 'Você não possui permissão para acessar essa funcionalidade!');
            return Redirect::to('usuarios');
        } else {
            /* $client = new \GuzzleHttp\Client();
            $result = $client->request('GET', env('APP_URL') . '/api/buildings');
            dd($result->getBody()); */
            $buildings = Building::all();
            return View::make('admin.cadastros.usuario.cadastro', compact('usuario', 'buildings'));
        }
    }

    public function update($id, Request $request)
    {
        $usuario = User::findOrFail($id);

        /* Valida o email do usuário */
        if($request['email'] != $usuario->email) {
            /* Valida o email */
            $request->validate([
                'email'  => 'bail|unique:users',
            ]);
        }

        $usuario->update([
            'name'              => $request['nome'],
            'email'             => $request['email'],
            'telefone1'         => $request['telefone1'],
            'telefone2'         => $request['telefone2'],
            'num_apartamento'   => $request['num_apartamento'],
            'qnt_pessoas'       => $request['qnt_pessoas'],
            'password'          => bcrypt($request['senha']),
            'access_level'      => $request['access_level'],
        ]);

        /* Caso altere as permissões do usuário, remove as ligações com as buildings */
        if ($request['access_level'] != '1') {
            DB::table('users_buildings')->where('user_id', $id)->delete();
        }

        \Session::flash('flash_message_success', 'Usuário <strong>'. $usuario->name . '</strong> atualizado com sucesso!');

        return Redirect::to('usuarios');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        \Session::flash('flash_message_success', 'Usuário removido com sucesso!');

        return Redirect::to('usuarios');
    }

    public function insereVinculo($user_id, $predio_id)
    {
        // Busca o usuário pelo ID
        $usuario = User::findOrFail($user_id);
        // Busca a Building pelo ID
        $building = Building::findOrFail($predio_id);

        /* Verifica se a Building escolhida já tem associação com o usuário */
        if($usuario->buildings->contains($predio_id) || $usuario->predio_id == $predio_id) {
            \Session::flash('flash_message_error', '<strong>'. $building->nomePredio . '</strong> já associada ao usuário!');
		} else {
            $usuario->buildings()->attach($predio_id);
            \Session::flash('flash_message_success', '<strong>'. $building->nomePredio . '</strong> associada com sucesso!');
		}
    }

    public function removeVinculo($user_id, $predio_id)
    {
        $usuario = User::findOrFail($user_id);
        $building = Building::findOrFail($predio_id);
        $usuario->buildings()->detach($predio_id);

        \Session::flash('flash_message_success', '<strong>'. $building->nomePredio . '</strong> removida com sucesso!');

        return Redirect::to('usuario/'. $user_id);
    }
}