@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1>Listados categorias:</h1>                   
@stop

@section('content')
@if(session('message'))
<div class="alert alert-success">
    <strong>{{session('message')}}</strong>
</div>
@endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.categories.create')}}"class= "btn btn-success ">Agregar categoria:</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>

                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                            <a href="{{route('admin.categories.edit',$category)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.categories.destroy',$category)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                   <button class="btn btn-danger btn-sm">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
