<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Redirect;

class AccountController extends Controller
{
    public function index()
    {
        $user_id = Auth()->user()->id;
        $_accounts = Account::where('user_id',$user_id)->get();
     
        return view('admin.cadastros.account.lista-accounts',['accounts'=>$_accounts]);

    }  
    public function novo()
    {
        return view('admin.cadastros.account.editar-account', compact('accounts')); 
    } 

    public function salvar(Request $request)
    {
        //    'name', 'cpf', 'tipo', 'email', 'password', 
       $_account = new Account();
       $_account = $_account->create([
        'predio_id' => Auth()->user()->predio_id,
        'user_id' =>  Auth()->user()->id,
        'month' => $request['month'],
        'year' => $request['year'],
        'consumo' => $request['consumo'],
        'dias_med' => $request['dias_med'],
    ]);
       

       \Session::flash('mensagem_sucesso','Cadastrado com sucesso!');
 
       return Redirect::to('accounts/novo');
    } 

    public function editar($id)
    {
        $_account = Account::findOrFail($id);
        return view('admin.cadastros.account.editar-account',['account' =>$_account]);
    }
 
    public function atualizar($id, Request $request)
    {
        $_account = Account::findOrFail($id);
        $_account->update([
            'predio_id' => Auth()->user()->predi_id,
            'user_id' =>  Auth()->user()->id,
            'month' => $request['month'],
            'year' => $request['year'],
            'consumo' => $request['consumo'],
            'dias_med' => $request['dias_med'],
        ]);
        \Session::flash('mensagem_sucesso','Atualizado com sucesso!');
        return Redirect::to('accounts/'.$_account->id.'/editar');
    }
 
    public function deletar($id)
    {
     $_account = Account::findOrFail($id);
     $_account->delete();
     \Session::flash('mensagem_sucesso','Conta deletada com sucesso!');
     return Redirect::to('accounts');
 
    }
}
