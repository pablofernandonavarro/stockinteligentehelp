@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Editar Rol: {{ $role->name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-body">
            {{-- Cambiamos el método a PUT para actualizar el rol existente --}}
            {{ html()->form('PUT', route('admin.roles.update', $role->id))->class('form-horizontal')->open() }}

            {{-- Precargamos el nombre del rol --}}
            {{ html()->label('Nombre del Role', 'name')->class('form-label') }}
            {{ html()->text('name', $role->name)
            ->class('form-control mb-3')
            ->placeholder('Ingrese el nombre del rol')}}

            @error('name')
            <small class="text-danger">
                {{$message}}
            </small>
            @enderror

            <h1>Lista de Permisos:</h1>
            @foreach ($permissions as $permission)
            <div class="">
                <label for="">
                    {{-- Comprobamos si el rol ya tiene este permiso asignado --}}
                    {{ html()->checkbox('permissions[]', $role->permissions->contains($permission->id), $permission->id)->class('mr-2') }}
                    {{$permission->description}}
                </label>
            </div>
            @endforeach

            <div class="mt-3">
                {{ html()->submit('Actualizar Rol')->class('btn btn-secondary') }}
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
