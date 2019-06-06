@extends('adminlte::page')
@section('content_header')
    <h1>
        Perfil
    </h1>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">

<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('/assets/imgs/user.png') }}" alt="User profile picture" />
                <h3 class="profile-username text-center" style="padding-top: 10px;"><strong>{{ Auth()->user()->name }}</strong></h3>
                <p class="text-muted text-center">{{ Auth()->user()->email }}</p>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
               
                <strong><i class="fa fa-phone margin-r-5"></i> Telefone</strong>
                <hr>
                 <p class="text-muted">{{ Auth()->user()->telefone1 }}  <br>  {{ Auth()->user()->telefone2 }}</p>
               
            </div>
        </div>
    </div>
    <div class="col-md-8">
        {!! Form::open(['method' => 'PATCH', 'url' => 'perfil']) !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados Pessoais</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('nome', 'Nome') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::input('text', 'nome', Auth()->user()->name, ['class' => 'form-control', 'id' => 'nome', 'placeholder' => 'Nome', 'autofocus', 'required', ((Auth()->user()->id == 73) ? 'readonly' : '') ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('email', 'E-mail') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-at"></i>
                                </div>
                                {!! Form::input('email', 'email', Auth()->user()->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-mail', 'required', ((Auth()->user()->id == 73) ? 'readonly' : '')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="form-group" style="padding-bottom: 15px;">
                        <div class="pull-right">
                            {!! Form::submit('Salvar dados', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

        @if (Auth()->user()->id != 73)
            {!! Form::open(['method' => 'PATCH', 'url' => 'senha']) !!}
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Alteração de Senha</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                {!! Form::label('senhaAtual', 'Senha Atual') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    {!! Form::input('password', 'senhaAtual', null, ['class' => 'form-control', 'id' => 'senhaAtual', 'placeholder' => 'Senha Atual', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {!! Form::label('novaSenha', 'Nova Senha') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    {!! Form::input('password', 'novaSenha', null, ['class' => 'form-control', 'id' => 'novaSenha', 'placeholder' => 'Nova Senha', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {!! Form::label('confirmacaoSenha', 'Confirmação de Senha') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    {!! Form::input('password', 'confirmacaoSenha', null, ['class' => 'form-control', 'id' => 'confirmacaoSenha', 'placeholder' => 'Confirmação de Senha', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 15px;">
                            <div class="pull-right">
                                {!! Form::submit('Atualizar Senha', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        @endif
    </div>
</div>
@endsection

@push('other_js')
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
{{--<script>
    $(function () {
        $(':checkbox').iCheck({
            checkboxClass: 'icheckbox_square-blue',
        });
    @if (Auth()->user()->access_level == 1)
    
        $(':checkbox').on('ifChecked', function () {
            /* Insere na sessão */
            buildingsGestor(1, $(this).val());
        }).on('ifUnchecked', function () {
            /* Remove da sessão */
            buildingsGestor(2, $(this).val());
        });
    });

        function buildingsGestor(acao, id) {
            $.ajax({
                type: 'GET',
                url: 'updateSession/' + acao + '/' + id,
                success: function(result) {
                    /* alert(result); */
                    /* $(element).removeClass('btn-secondary btn-danger btn-success').addClass('btn-success'); */
                },
                error: function(result) {
                    alert('deu erro');
                    /* $(element).removeClass('btn-secondary btn-danger btn-success').addClass('btn-danger'); */
                }
            });
        }
    @else
});
    @endif
</script>--}}
@endpush