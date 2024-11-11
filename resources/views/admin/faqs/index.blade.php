@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
    <h1>Preguntas Frecuentes:</h1>
@stop

@section('content')



    <div>

        <div>

        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-success ">Crear Pregunta Frecuente</a>
            </div>
            @if ($faqs->count())
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th>Categoria</th>
                                    <th>Estado</th>

                                    <th>Prioridad</th>
                                    <th class="text-center" colspan="4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>{{ $faq->category->name }}</td>
                                        <td
                                            class="{{ $faq->is_active == 1 ? 'badge bg-success  my-3 p-1' : 'badge bg-secondary my-3 p-1' }}">
                                            {{ $faq->is_active == 1 ? 'Activa' : 'desactivada' }}</td>
                                        <td>{{ $faq->priority }}</td>
                                        <td class="text-center">
                                        <th>
                                            <a href="{{ route('admin.faqs.show', $faq) }}"
                                                class="btn btn-secondary btn-sm">Ver </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('admin.faqs.edit', $faq) }}"
                                                class="btn btn-primary btn-sm">Editar </a>
                                        </th>
                                        <th class="btn-group" role="group">

                                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </th>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    {{ $faqs->links() }}
                </div>
            @else
                <div class="card-body">
                    <strong class="alert alert-danger">no existe ninguna Publicacion con ese nombre .......</strong>
                </div>

            @endif

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
