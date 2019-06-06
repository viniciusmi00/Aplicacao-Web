@extends('adminlte::page')
@section('content_header')
    <h1>
        Edíficio
    </h1>
@endsection

@section('content')
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                @if($building->id > 0)
                    {!! Form::model($building, ['method' => 'PATCH', 'url'=> 'building/'. $building->id]) !!}
                @else
                    {!! Form::open(['url' => 'building']) !!}
                @endif

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Dados do Edíficio</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                {!! Form::label('nomePredio', 'Razão Social') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                    {!! Form::input('text', 'nomePredio', $building->nomePredio, ['class' => 'form-control', 'id' => 'nomePredio', 'placeholder' => 'Razão Social', 'autofocus', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header">
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
                                    {!! Form::input('text', 'CEP', $building->cep, ['class' => 'form-control', 'id' => 'CEP', 'data-mask' => '00000-000', 'maxlength' => '10', 'placeholder' => '00000-000', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('logradouro', 'Logradouro') !!}
                                {!! Form::input('text', 'logradouro', $building->logradouro, ['class' => 'form-control', 'id' =>'logradouro', 'placeholder' => 'Logradouro', 'maxlength' => 70, 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('numero', 'Número') !!}
                                {!! Form::input('text', 'numero', $building->numero, ['class' => 'form-control', 'id' => 'numero', 'placeholder' => 'Número', 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('complemento', 'Complemento') !!}
                                {!! Form::input('text', 'complemento', $building->complemento, ['class' => 'form-control', 'id' => 'complemento', 'placeholder' => 'Complemento']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                {!! Form::label('bairro', 'Bairro') !!}
                                {!! Form::input('text', 'bairro', $building->bairro, ['class' => 'form-control', 'id' => 'bairro', 'placeholder' => 'Bairro', 'required']) !!}
                            </div>
                            <div class="form-group col-md-5">
                                {!! Form::label('municipio', 'Município') !!}
                                {!! Form::input('text', 'municipio', $building->municipio, ['class' => 'form-control', 'id' => 'municipio', 'placeholder' => 'Município', 'required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                {!! Form::label('uf', 'UF') !!}
                                {!! Form::input('text', 'uf', $building->uf, ['class' => 'form-control', 'id' =>'uf', 'placeholder' => 'UF', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if($building->id > 0)
                @else
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
                @endif
                <a href="{{ url('buildings') }}" class="btn btn-flat btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>
                {!! Form::button('Salvar&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-flat btn-success pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="{{ asset('assets/js/Enderecos.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('../assets/js/MascaraValidacao.js') }}" type="text/javascript"></script>
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