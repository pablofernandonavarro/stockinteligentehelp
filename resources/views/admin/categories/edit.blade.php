@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1>Editar Categoria:</h1>
@stop

@section('content')
@if(session('mesagge'))
<div class="alert alert-success">
    <strong>{{session('message')}}</strong>
</div>
@endif
<div class="card-body">
    {{-- Se cambia a PUT ya que es una actualización de un recurso existente --}}
    {{ html()->form('PUT', route('admin.categories.update', $category))->class('form-horizontal')->open() }}

    <div class="mb-3">
        {{-- Campo de nombre de la categoría --}}
        {{ html()->label('Nombre de la categoría', 'category_name')->class('form-label') }}
        {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Ingrese el nombre de la categoría')
                ->value(old('name', $category->name)) }}

        {{-- Mostrar mensajes de error --}}
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">

        {{ html()->submit('Actualizar Categoria')->class('btn btn-success') }}
    </div>

    {{ html()->form()->close() }}
</div>

@stop
