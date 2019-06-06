<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Building;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Validator;
use View;

class BuildingController extends Controller
{
    public function index()
    {
        
        if(Auth()->user()->id == '2')
        {
            $buildings = Building::orderBy('nomePredio')->get();

            return View::make('admin.buildings.index')->with('buildings', $buildings);
        } else {
            return Redirect::to('building/'.Auth()->user()->predio_id);
        }
    }

    public function create()
    {
        $building = new Building;

        return View::make('admin.buildings.cadastro', compact('building'));
    }

    public function edit($id)
    {
        if($id != Auth()->user()->predio_id && Auth()->user()->email != 'admin@teste.com')
        {
            return Redirect::to('building/'.Auth()->user()->predio_id);
        } else {
            $building = Building::findOrFail($id);

            return View::make('admin.buildings.cadastro')->with('building', $building);
        }
    }

    public function registrar()
    {
        return View::make('site.home.building', compact('building'));
    }

    public function store(BuildingRequest $request)
    {
        /*
               $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nomePredio', 50);
            $table->string('cep', 10);
            $table->string('logradouro', 70);
            $table->string('numero',20);
            $table->string('complemento', 40)->nullable();
            $table->string('bairro', 40);
            $table->string('cidade', 40);
            $table->string('uf', 2);
            $table->timestamps();*/
        $building = Building::create([
            'nomePredio'   => $request['nomePredio'],
            'cep'           => $request['CEP'],
            'logradouro'    => $request['logradouro'],
            'numero'        => $request['numero'],
            'complemento'   => $request['complemento'],
            'bairro'        => $request['bairro'],
            'municipio'     => $request['municipio'],
            'uf'            => $request['uf'],

        ]);

        $usuario = User::create([
            'name'          => $request['nome'],
            'email'         => $request['email'],
            'telefone1'         => $request['telefone1'],
            'telefone2'         => $request['telefone2'],
            'num_apartamento'   => $request['num_apartamento'],
            'qnt_pessoas'       => $request['qnt_pessoas'],
            'password'      => bcrypt($request['senha']),
            'access_level'  => '2',
            'predio_id'    => $building->id,
        ]);

        /* Caso o Administrador esteja inserindo uma building */
        if(Auth::check()){
            \Session::flash('flash_message_success', 'Building e usuário cadastrados com sucesso!');
        } else { /* Caso o registro esteja sendo feito pela página inicial, autentica com o usuário criado */
            Auth::login($usuario, true);
        }

        return Redirect::to('admin');
    }

    public function update($id, Request $request)
    {
        $building = Building::findOrFail($id);

        $building->update([
            'nomePredio'   => $request['nomePredio'],
            'cep'           => $request['CEP'],
            'logradouro'    => $request['logradouro'],
            'numero'        => $request['numero'],
            'complemento'   => $request['complemento'],
            'bairro'        => $request['bairro'],
            'municipio'     => $request['municipio'],
            'uf'            => $request['uf'],
        ]);

        \Session::flash('flash_message_success','Building <strong>' . $building->nomePredio . '</strong> atualizada com sucesso!');

        return Redirect::to('buildings');
    }

    public function destroy($id)
    {
        $building = building::findOrFail($id);
        $building->delete();

        \Session::flash('flash_message_success', 'Building removida com sucesso!');

        return Redirect::to('buildings');
    }
}
