@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/form-elements.css">
    <link rel="stylesheet" href="/assets/css/style.css">


    @yield('css')

@endsection

@section('body_class', 'login-page')

@section('body')

<div class="login-box">
    <!-- /.login-logo -->         
    <div class="login-box-body">
            <div class="login-logo">
                    <a href="{{ route('home') }}">{!! config('adminlte.logo_login', '<b>Consultar</b>') !!}</a>
                </div>
        <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}" autofocus />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control"
                        placeholder="{{ trans('adminlte::adminlte.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-block ">{{ trans('adminlte::adminlte.sign_in') }}</button>
                </div>
                <div class="col-md-4">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember">&nbsp;&nbsp;{{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div>
                    </div>
            </div>
        </form>
        <div class="auth-links">
            <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                class="text-center">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
            <br>
            @if (config('adminlte.register_url', 'registrar'))
                <a href="{{ url(config('adminlte.register_url', 'registrar')) }}"
                    class="text-center"
                >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
            @endif  
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@yield('js')
@endsection
