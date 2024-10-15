@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Asignar un Rol:</h1>
@stop

@section('content')
@if (session('message'))
       <div class="alert alert-success">
        <strong>{{session('message')}}</strong>
       </div>
@endif


<div class="card">
    <div class="card-body">
        <p class="h5">Nombre</p>
        <p class="form-control">{{$user->name}}</p>
        <h2>Listado de Roles</h2>
        {!! html()->modelForm($user, 'PUT', route('admin.users.update',$user))->class('form-horizontal p-3')->autocomplete('off')->open() !!}
        @csrf
        @method('PUT')
        <div class="form-group">

            @foreach ($roles as $role)
            <div class="form-check">

                {{ html()->checkbox('roles[]', $user->role, $role->id)
                ->class('form-check-input')
                ->id('etiqueta_'.$role->id) }}
                {{ html()->label($role->name, 'role_'.$role->id)->class('form-check-label') }}
            </div>
            @endforeach
            <div class="mb-3">
                {{ html()->submit('Asignar Rol')->class('btn btn-secondary float-right my-2 mx-2') }}
            </div>

            @error('etiquetas')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
  




        {{ html()->form()->close() }}
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop