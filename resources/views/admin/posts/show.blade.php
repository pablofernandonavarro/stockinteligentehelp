@extends('adminlte::page')

@section('title', 'Ver Publicación')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Ver Publicación</h1>
@stop

@section('content')
<div class="card p-3">

    <div class="form-group">
        <label class="form-label">Nombre de la Publicación</label>
        <p class="form-control">{{ $post->name }}</p>
    </div>

    <div class="form-group">
        <label class="form-label">Slug</label>
        <p class="form-control">{{ $post->slug }}</p>
    </div>

    <div class="form-group">
        <label class="form-label">Categoría</label>
        <p class="form-control">{{ $post->category->name }}</p>
    </div>

    <div class="form-group">
        <p class="font-weight-bold">Etiquetas:</p>
        @foreach ($post->etiquetas as $etiqueta)
        <span class="badge badge-primary">{{ $etiqueta->name }}</span>
        @endforeach
    </div>

    <div class="form-group py-3">
        <p class="font-weight-bold">Estado:</p>
        <p class="form-control">{{ $post->status == 1 ? 'Borrador' : 'Publicado' }}</p>
    </div>

    <!-- Imagen -->
    <div class="row">
        <div class="col">
            <div class="image-wrapper">
                <img src="{{ $post->image ? Storage::url($post->image->url) : asset('storage/CoreImages/SinPhoto.jpeg') }}" alt="" id="picture">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <strong>Dimensiones de la Imagen:</strong>
                <p>Alto: 1024 px</p>
                <p>Ancho: 610 px</p>
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ html()->label('Extracto:', 'extract')->class('form-label') }}
        {{ html()->textarea('extract', $post->extract)->class('form-control')->id('extract')}}
        @error('extract')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        {{ html()->label('Extracto:', 'extract')->class('form-label') }}
        {{ html()->textarea('extract', $post->body)->class('form-control')->id('body')}}
        @error('extract')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

</div>
@stop

@section('css')
<style>
    .image-wrapper {
        position: relative;
        padding-bottom: 10%;
    }

    .imagen-wrapper-img {
        position: absolute;
        object-fit: cover;
        height: 100%;
    }
</style>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
<script>
    
    ClassicEditor
        .create(document.querySelector("#extract"))
        .catch(error => {
            console.log(error);
        });
    ClassicEditor
        .create(document.querySelector("#body"))
        .catch(error => {
            console.log(error);
        });
</script>
@stop