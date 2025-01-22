@extends('adminlte::page')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('title', 'Usuarios')

@section('content_header')
    <h1 class="d-flex justify-content-center mx-auto my-auto">Lista de Novedades :</h1>
@stop

@section('content')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.news.create') }}"class="btn btn-success ">Agregar Novedad:</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Estado</th>
                        <th>Titulo</th>
                        <th>Publicado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $new)
                        <tr>

                            <td>{{ $new->id }}</td>
                            <td>{{ $new->status }}</td>
                            <td>{{ $new->title }}</td>
                            <td>{{ $new->published_at }}</td>
                            <td width="20px">
                                <a href="{{ route('admin.news.show', $new) }}" class="btn btn-sm btn-secondary">Ver</a>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.news.edit', $new) }}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.news.destroy', $new) }}" method="POST">
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


@if(session('success'))
    <script>
        Swal.fire({
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@stop
@stop
