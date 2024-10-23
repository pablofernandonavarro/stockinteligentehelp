@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1>Listados etiquetas:</h1>
@stop

@section('content')
@if(session('mesagge'))
<div class="alert alert-success">
    <strong>{{session('mesagge')}}</strong>
</div>
@endif
<div class="card">
    <div class="card-header">
        <a href="{{route('admin.etiquetas.create')}}" class="btn btn-success">Agregar Etiqueta</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etiquetas as $etiqueta)
                    <tr>
                        <td>{{ $etiqueta->id }}</td>
                        <td width="5px">
                            @php
                            $color = $etiqueta->color ?? '#ffffff'; // Asigna blanco si no hay color
                            @endphp
                            <div style="width: 20px; height: 20px; background-color: {{ $etiqueta->color }}; border: 1px solid #000;"></div>
                        </td>
                        <td>{{ $etiqueta->name }}</td>
                        <td>{{ $etiqueta->color }}</td>
                        <td width="10px">
                            <a href="{{route('admin.etiquetas.edit',$etiqueta)}}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                        <td width="10px">
                            <form action="{{route('admin.etiquetas.destroy',$etiqueta)}}" method="POST">
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
</div>
@stop

@section('css')
{{-- Aquí puedes agregar estilos adicionales si es necesario --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop