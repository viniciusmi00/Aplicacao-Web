@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@endsection

@section('body')
    <style>
        .register-logo {
            margin-bottom: 0 !important;
        }
    </style>
    <class="box">
    <!--<div<div class="register-box">Formulario semelhante a tela de login-->
        <div class="register-logo">
            {{--  <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo_login', '<b>Consultar</b>') !!}</a>  --}}
            <a href="{{ route('home') }}">{!! config('adminlte.logo_login', '<b>Consultar</b>') !!}</a>
        </div>
        {{--  <section class="content-header">
            @yield('content_header')
        </section>  --}}
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
        @if(config('adminlte.layout') == 'top-nav')
        </div>
        <!-- /.container -->
        @endif
    </div>
@endsection

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@endsection