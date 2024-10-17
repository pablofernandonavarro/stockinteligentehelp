@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Crear Role:</h1>
@stop

@section('content')
@if(session('info'))
  <div class="aler alert-success">
    <span>{{session('info')}}</span>
  </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="card-body">
            {{ html()->form('POST', route('admin.roles.store'))->class('form-horizontal')->open() }}

            {{ html()->label('Nombre del Role', 'name')->class('form-label') }}
            {{ html()->text('name',null)
            ->class('form-control mb-3')
            ->placeholder('Ingrese el nombre del rol')}}

            @error('name')
            <small class="text-danger">
                {{$message}}
            </small>

            @enderror
            <h1>Lista de Permisos:</h1>
            @foreach ($permissions as $permission )
            <div class="">
                <label for="">
                    {{html()->checkbox('permissions[]',false,$permission->id)->class('mr-2')}}
                    {{$permission->description}}
                </label>
            </div>
            @endforeach

            <div class="mt-3">
                {{ html()->submit('Crear rol')->class('btn btn-secondary') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop