Empresa HOME

@extends('adminlte::simple')

@section('content')
    <style>
        body {
            background-color: #ecf0f5;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- Exibe os erros no momento do cadastro --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ Form::open(['url' => 'registrar']) }}
                {{--  Dados da predio  --}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados do Edíficio</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                {!! Form::label('nomePredio', 'Nome do Edifício') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                    {!! Form::input('text', 'nomePredio', null, ['class' => 'form-control', 'id' => 'nomePredio', 'placeholder' => 'Nome do Edifício', 'autofocus', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  Endereço do predio  --}}
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Endereço</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                {!! Form::label('CEP', 'CEP') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    {!! Form::input('text', 'CEP', null, ['class' => 'form-control', 'id' => 'CEP', 'data-mask' => '00000-000', 'maxlength' => '10', 'placeholder' => '00000-000', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('logradouro', 'Logradouro') !!}
                                {!! Form::input('text', 'logradouro', null, ['class' => 'form-control', 'id' =>'logradouro', 'placeholder' => 'Logradouro', 'maxlength' => 70, 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('numero', 'Número') !!}
                                {!! Form::input('text', 'numero', null, ['class' => 'form-control', 'id' => 'numero', 'placeholder' => 'Número', 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('complemento', 'Complemento') !!}
                                {!! Form::input('text', 'complemento', null, ['class' => 'form-control', 'id' => 'complemento', 'placeholder' => 'Complemento']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                {!! Form::label('bairro', 'Bairro') !!}
                                {!! Form::input('text', 'bairro', null, ['class' => 'form-control', 'id' => 'bairro', 'placeholder' => 'Bairro', 'required']) !!}
                            </div>
                            <div class="form-group col-md-5">
                                {!! Form::label('municipio', 'Município') !!}
                                {!! Form::input('text', 'municipio', null, ['class' => 'form-control', 'id' => 'municipio', 'placeholder' => 'Município', 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('uf', 'UF') !!}
                                {!! Form::input('text', 'uf', null, ['class' => 'form-control', 'id' =>'uf', 'placeholder' => 'UF', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{--  Usuário padrão  --}}
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuário Padrão</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                {!! Form::label('nome', 'Nome') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    {!! Form::input('text', 'nome', null, ['class' => 'form-control', 'id' =>'nome', 'placeholder' => 'Nome do usuário', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                {!! Form::label('email', 'E-mail') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-at"></i>
                                    </div>
                                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'id' =>'email', 'placeholder' => 'E-mail', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('senha', 'Senha') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    {!! Form::input('password', 'senha', null, ['class' => 'form-control', 'id' =>'senha', 'placeholder' => 'Senha', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="auth-links">
                                    <a href="{{ url(config('adminlte.login_url', 'login')) }}" class="text-left"><h4>Já tem cadastro? Clique aqui para acessar o sistema.</h4></a>
                                </div>
                            </div>
                            <div class="form-group col-md-offset-10">
                                {!! Form::submit('Cadastrar Edifício', ['class' => 'btn btn-flat btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/Enderecos.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/MascaraValidacao.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            var sMascara = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            sOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(sMascara.apply({}, arguments), options);
                }
            };

            $('.telefone').mask(sMascara, sOptions);
        });
    </script>
@endsection