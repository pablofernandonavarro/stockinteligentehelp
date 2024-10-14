@extends('adminlte::page')

@section('title', 'Listado Publicaciones')

@section('content_header')
<a href="{{route('admin.posts.create')}}" class="btn btn-secondary btn-sm float-right">Crear una publicacion</a>
<h4 class="">Listado de Publicaciones</h4>
@if(session('mesagge'))
<div class="alert alert-success">
    <strong>{{session('mesagge')}}</strong>
</div>
@endif
@stop

@section('content')
    @livewire("admin.posts-index")
@stop

@section('css')
@livewireStyles
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop

