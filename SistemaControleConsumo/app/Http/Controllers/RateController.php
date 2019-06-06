<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rate;
use Redirect;
use Auth;


class RateController extends Controller
{
    public function index()
    {
        $predio_id = Auth()->user()->predio_id;
        $_rates = Rate::where('predio_id',$predio_id)->get();
        return view('admin.cadastros.rate.lista-rates',['rates'=>$_rates]);
    
    }  
    public function novo()
    {
        return view('admin.cadastros.rate.editar-rate', compact('rates')); 
    } 
    
    public function salvar(Request $request)
    {
        //    'name', 'cpf', 'tipo', 'email', 'password', 
       $_rate = new Rate();
       $_rate = $_rate->create([
        'predio_id' => Auth()->user()->predio_id,
        'baixo' => $request['baixo'],
        'medio' => $request['medio'],
        'alto' => $request['alto'],
        'meta' => $request['meta'],
        'faixa' => $request['faixa'],
        'valor' => $request['valor'],
    ]);
       
    
       \Session::flash('mensagem_sucesso','Cadastrado com sucesso!');
    
       return Redirect::to('rates/novo');
    } 
    
    public function editar($id)
    {
        $_rate = Rate::findOrFail($id);
        return view('admin.cadastros.rate.editar-rate',['rate' =>$_rate]);
    }
    
    public function atualizar($id, Request $request)
    {
        $_rate = Rate::findOrFail($id);
        $_rate->update([
        'predio_id' => Auth()->user()->predio_id,
        'baixo' => $request['baixo'],
        'medio' => $request['medio'],
        'alto' => $request['alto'],
        'meta' => $request['meta'],
        'faixa' => $request['faixa'],
        'valor' => $request['valor'],
        ]);
        \Session::flash('mensagem_sucesso','Atualizado com sucesso!');
        return Redirect::to('rates/'.$_rate->id.'/editar');
    }
    
    public function deletar($id)
    {
     $_rate = Rate::findOrFail($id);
     $_rate->delete();
     \Session::flash('mensagem_sucesso','Parametro deletado com sucesso!');
     return Redirect::to('rates');
    
    }
}





