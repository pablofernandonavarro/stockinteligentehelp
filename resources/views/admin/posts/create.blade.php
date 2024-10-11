@extends('adminlte::page')

@section('title', 'Crear Publicación')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Crear Publicación</h1>
@stop

@section('content')
<div class="card">
    {{ html()->form('POST', route('admin.categories.store'))->class('form-horizontal p-3')->autocomplete('off')->open() }}

    <div class="form-group">
        {{ html()->label('Nombre de la Publicación', 'name')->class('form-label') }}
        {{ html()->text('name')->class('form-control')->placeholder('Ingrese el nombre de la Publicación') }}
        @error('name')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        {{ html()->label('Slug', 'slug')->class('form-label') }}
        {{ html()->text('slug')->class('form-control')->placeholder('Slug generado automáticamente') }} {{-- Campo slug con readonly --}}
        @error('slug')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        {{ html()->label('Seleccionar categoria', 'category_id')->class('form-label') }}
        {{ html()->select('etiqueta_id', $categories)->class('form-control') }}
        @error('category_id')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <p class="font-weight-bold">Etiquetas:</p>
        @foreach ($etiquetas as $etiqueta)
        <div class="form-check">
            {{ html()->checkbox('etiquetas[]', false, $etiqueta->id)->class('form-check-input')->id('etiqueta_'.$etiqueta->id) }}
            {{ html()->label($etiqueta->name, 'etiqueta_'.$etiqueta->id)->class('form-check-label') }}
        </div>
        @endforeach
        @error('etiquetas')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <p class="font-weight-bold">Estado:</p>
        <label>
            {{ html()->radio('status', 1,'true')->class('form-control') }}
            Borrador
        </label>
        <label>
            {{ html()->radio('status', 2,)->class('form-control') }}
            Publicado
        </label>
        @error('status')
        <span class='text-danger'>{{$message}}</span>
        @enderror

    </div>
</div>
<div class="form-group">
    {{ html()->label('Extracto:', 'extract')->class('form-label') }}
    {{ html()->textarea('extract', null)->class('form-control')->id('extract')}}
    @error('extract')
        <span class='text-danger'>{{$message}}</span>
        @enderror
</div>
<div class="form-group">
    {{ html()->label('Cuerpo del la Publicación:', 'body')->class('form-label') }}
    {{ html()->textarea('body', null)->class('form-control') }}
</div>
@error('body')
        <span class='text-danger'>{{$message}}</span>
        @enderror



<div class="mb-3">
    {{ html()->submit('Crear Publicación')->class('btn btn-secondary float-right my-2 mx-2') }}
</div>

{{ html()->form()->close() }}
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
<!-- <script>
    $(document).ready(function() { // Corrección de "documnet" a "document"
        $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug', // Asegúrate de que esto coincida con el ID del campo slug
            space: '-'
        });
    });
</script> -->
@stop