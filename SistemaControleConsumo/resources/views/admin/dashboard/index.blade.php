@extends('adminlte::page')

@section('title', 'SisTransfer')

@section('content_header')
    <h1>BEM VINDO</h1>
@stop

@section('content')
   
    Bem vindo {{Auth()->user()->name}}!
   
    
@stop
