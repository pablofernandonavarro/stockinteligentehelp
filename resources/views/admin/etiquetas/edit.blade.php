@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1>Editar Etiqueta:</h1>
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

 @include('admin.etiquetas.partials.form')

    <div class="mb-3">

        {{ html()->submit('Actualizar Etiqueta')->class('btn btn-success') }}
    </div>

    {{ html()->form()->close() }}
</div>

@stop