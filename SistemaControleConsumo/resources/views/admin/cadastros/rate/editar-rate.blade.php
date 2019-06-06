@extends('adminlte::page')

@section('content_header')
    <h1>Cadastro de Usuário</h1>
@endsection

@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Parâmetros</h3>
                    <a class="pull-right btn btn-info" href="{{url('rates')}}">Voltar</a>
                    <h1></h1>
                    @if(Session::has('mensagem_sucesso'))
                    <div class="alert alert-success">{{Session::get('mensagem_sucesso')}}</div>
                    @endif
                    
                    @if(Request::is('*/editar'))
                    <h5 class="page-title">Editar Parâmetros</h5>
                    {!! Form::model($rate, ['method' => 'PATCH', 'url'=> 'rates/'.$rate->id]) !!}
                    
                    @else
                    {!! Form::open(['url' => 'rates/salvar']) !!}

                    @endif
                    {!! Form::label('baixo','Consumo Baixo*') !!}
                    {!! Form::input('text','baixo', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Consumo Baixo', 'required']) !!}

                    {!! Form::label('medio','Consumo Médio*') !!}
                    {!! Form::input('text','medio', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Consumo Médio', 'required']) !!}

                    {!! Form::label('alto','Consumo Alto*') !!}
                    {!! Form::input('text','alto', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Consumo Alto', 'required']) !!}
 
                    {!! Form::label('meta','Meta Geral') !!}
                    {!! Form::input('text','meta', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Meta Geral']) !!}

                    {!! Form::label('valor','Valor da Tarifa') !!}
                    {!! Form::input('text','valor', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Valor da Tarifa']) !!}
                  
                </br>
                    {!! Form::submit('Salvar',['class' => 'btn btn-primary']) !!}
                   {!! Form::close() !!}         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection