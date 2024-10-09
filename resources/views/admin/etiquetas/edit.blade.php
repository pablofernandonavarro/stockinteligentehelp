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
    {{ html()->form('PUT', route('admin.etiquetas.update', $etiqueta))->class('form-horizontal')->open() }}

    <div class="mb-3">
        {{-- Campo de nombre de la categoría --}}
        {{ html()->label('Nombre de la Etiqueta', 'name')->class('form-label') }}
        {{ html()->text('name')
                ->class('form-control')
                ->placeholder('Ingrese el nombre de la etiqueta')
                ->value(old('name', $etiqueta->name)) }}
        {{ html()->label('Color de la Etiqueta', 'color')->class('form-label') }}
        {{ html()->text('color')
                ->class('form-control')
                ->placeholder('Ingrese el Color de la etiqueta')
                ->value(old('color', $etiqueta->color)) }}

        {{-- Mostrar mensajes de error --}}
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">

        {{ html()->submit('Actualizar Etiqueta')->class('btn btn-success') }}
    </div>

    {{ html()->form()->close() }}
</div>

@stop