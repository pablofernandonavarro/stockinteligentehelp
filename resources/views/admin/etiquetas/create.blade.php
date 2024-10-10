@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
    <h1>Crear nueva Etiqueta:</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{ html()->form('POST', route('admin.etiquetas.store'))->class('form-horizontal')->open() }}

            @include('admin.etiquetas.partials.form')

            <div class="mb-3">
                {{ html()->submit('Crear Categoria')->class('btn btn-success') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    @stop
