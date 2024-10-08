@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
    <h1>Editar Categoria:</h1>
@stop

@section('content')

    {{ html()->form('PUT', '/post')->class('form-horizontal')->open() }}

    <div class="mb-3">
        {{ html()->label('Nombre de la categoría', 'category_name')->class('form-label') }}
        {{ html()->text('category_name')->class('form-control')->placeholder('Nombre de la categoría') }}
        {{ html()->label('', 'category_name')->class('form-label') }}
        {{ html()->text('category_name')->class('form-control')->placeholder('Nombre de la categoría') }}
    </div>

    <div class="mb-3">
        {{ html()->submit('Guardar')->class('btn btn-primary') }}
    </div>

    {{ html()->form()->close() }}

@stop

