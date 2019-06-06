<?php

namespace App\Http\Controllers\Admin;

use App\Util;
use App\User;
use App\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use View;

class AdminController extends Controller
{
    public function index()
    {
        return view ('admin.dashboard.index');
    }

    public function perfil()
    {
        
        $buildings = DB::select(DB::raw('SELECT id, nomePredio FROM users_buildings JOIN buildings ON predio_id = id WHERE user_id = '. Auth()->user()->id));
        return View::make('site.perfil')->with('buildings', $buildings);
    
    }

    public function atualizaBuildingSessao($acao, $id)
    {
        /* 1 = INSERE */
        /* 2 = REMOVE */
        $buildings = \Session::get('buildings');
        
        switch ($acao) {
            case 1:
                $buildings[] = $id;
                \Session::put('buildings', $buildings);
                break;
            case 2:
                $pos = array_search($id, $buildings);
                unset($buildings[$pos]);
                \Session::put('buildings', $buildings);
                break;
        }
    }

    public function atualizaPerfil(Request $request)
    {
        $usuario = User::find(Auth()->user()->id);

        /* Valida o email do usuário */
        if($request['email'] != $usuario->email) {
            /* Valida o email */
            $request->validate([
                'email'  => 'bail|unique:users',
            ]);
        }

        $usuario->name = $request->nome;
        $usuario->email = $request->email;
        $usuario->save();

        \Session::flash('flash_message_success', 'Usuário atualizado com sucesso!');

        return Redirect::to('perfil');
    }

    public function atualizaSenha(Request $request)
    {
        $user = User::find(Auth()->user()->id);

        $user->password = bcrypt($request->novaSenha);
        $user->save();

        \Session::flash('flash_message_success', 'Senha atualizada com sucesso!');

        return Redirect::to('perfil');
    }
}
