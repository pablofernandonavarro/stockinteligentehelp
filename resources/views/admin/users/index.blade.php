@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="d-flex justify-content-center mx-auto my-auto">Lista de Usuarios :</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
   
@stop
