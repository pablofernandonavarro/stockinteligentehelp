@extends('adminlte::page')

@section('title', 'Listado Publicaciones')

@section('content_header')
<a href="{{route('admin.posts.create')}}" class="btn btn-secondary btn-sm float-right">Crear una publicacion</a>
<h4 class="">Listado de Publicaciones</h4>

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
@if(session('success'))
    <script>
        Swal.fire({
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@stop

