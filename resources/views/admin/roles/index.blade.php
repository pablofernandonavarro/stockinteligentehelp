@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
@if(session('info'))
  <div class="alert alert-success">
    <span>{{session('info')}}</span>
  </div>
@endif

<a href="{{route('admin.roles.create')}}" class="btn  btn-secondary float-right">Crear Nuevo Rol:</a>
<h1 class="d-flex justify-content-center mx-auto my-auto">Lista Roles :</h1>
@stop

@section('content')



<div class="card">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>Id</th>
              <th>Role</th>
              <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
          <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td width="10px">
                <a href="{{route('admin.roles.edit',$role)}}" class="btn btn-primary btn-sm">Editar</a>
            </td>
            <td width="10px">
                <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
          </tr>
            
            @endforeach

        </tbody>
    </table>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop