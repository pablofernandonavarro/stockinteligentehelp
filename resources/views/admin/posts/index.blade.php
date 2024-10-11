@extends('adminlte::page')
@livewireStyles
@section('title', 'StockInteligente')

@section('content_header')
    <h4 class="d-flex justify-content-center mx-auto my-auto">Listado de Publicaciones</h4>
@stop

@section('content')
    @livewire("admin.posts-index")
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

