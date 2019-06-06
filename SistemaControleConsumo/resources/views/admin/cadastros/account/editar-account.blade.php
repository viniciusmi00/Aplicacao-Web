@extends('adminlte::page')

@section('content_header')
    <h1>Cadastro de Contas</h1>
@endsection

@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contas</h3>
                    <a class="pull-right btn btn-info" href="{{url('accounts')}}">Voltar</a>
                    <h1></h1>
                    @if(Session::has('mensagem_sucesso'))
                    <div class="alert alert-success">{{Session::get('mensagem_sucesso')}}</div>
                    @endif
                    
                    @if(Request::is('*/editar'))
                    <h5 class="page-title">Editar Contas</h5>
                    {!! Form::model($user, ['method' => 'PATCH', 'url'=> 'accounts/'.$user->id]) !!}
                    
                    @else
                    {!! Form::open(['url' => 'accounts/salvar']) !!}

                    @endif
                    {!! Form::label('month','Mês Referência') !!}
                    {!! Form::input('text','month', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Mês Referencia', 'required']) !!}

                    {!! Form::label('year','Ano Referência') !!}
                    {!! Form::input('text','year', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Ano Referência', 'required']) !!}

                    {!! Form::label('consumo','Consumo Total') !!}
                    {!! Form::input('text','consumo', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Consumo Total', 'required']) !!}
 
                    {!! Form::label('dias_med','Dia entre medições') !!}
                    {!! Form::input('text','dias_med', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Dia entre medições', 'required']) !!}
                  
                </br>
                    {!! Form::submit('Salvar',['class' => 'btn btn-primary']) !!}
                   {!! Form::close() !!}         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection