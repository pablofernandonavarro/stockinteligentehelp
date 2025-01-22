@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="d-flex justify-content-center mx-auto my-auto">Novedad :</h1>
@stop

@section('content')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif
  
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Detalles de la Novedad</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-3"><strong>Título:</strong> {{ $news->title }}</h4>
                        <p><strong>Slug:</strong> {{ $news->slug }}</p>
                        <p ><strong>Contenido:</strong></p>
                        <p >{!! $news->content !!}</p>
                        
                        @if ($news->image)
                            <p><strong>Imagen:</strong></p>
                            <img src="{{ $news->image ? Storage::url($news->image) : asset('storage/CoreImages/SinPhoto.jpeg') }}" alt="Imagen de {{ $news->title }}" class="img-fluid mb-3">
                        @else
                            <p><strong>Imagen:</strong> No disponible</p>
                        @endif

                        <p><strong>Fecha de Publicación:</strong> 
                            {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Sin publicar' }}
                        </p>
                        <p><strong>Autor:</strong> {{ $news->author->name }}</p>
                        <p><strong>Categoría:</strong> {{ $news->category->name }}</p>
                        <p><strong>Destacada:</strong> {{ $news->is_featured ? 'Sí' : 'No' }}</p>
                        <p><strong>Estado:</strong> {{ ucfirst($news->status) }}</p>
                        <p><strong>Fecha de Creación:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última Actualización:</strong> {{ $news->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-warning">Editar</a>
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
