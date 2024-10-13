@extends('adminlte::page')

@section('title', 'Crear Publicación')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Crear Publicación</h1>
@stop

@section('content')
<div class="card">
    {{ html()->form('POST', route('admin.posts.store'))->class('form-horizontal p-3')->autocomplete('off')->attributes(['enctype' => 'multipart/form-data', 'accept' => 'image/*'])->open() }}

    {{ html()->hidden('user_id', auth()->user()->id) }}

    <div class="form-group">
        {{ html()->label('Nombre de la Publicación', 'name')->class('form-label') }}
        {{ html()->text('name')->class('form-control')->placeholder('Ingrese el nombre de la Publicación') }}
        @error('name')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        {{ html()->label('Slug', 'slug')->class('form-label') }}
        {{ html()->text('slug')->class('form-control')->placeholder('Slug generado automáticamente')->isReadonly() }}

        @error('slug')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        {{ html()->label('Seleccionar categoria', 'category_id')->class('form-label') }}
        {{ html()->select('category_id', $categories,null)->class('form-control') }}
        @error('category_id')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <p class="font-weight-bold">Etiquetas:</p>
        @foreach ($etiquetas as $etiqueta)
        <div class="form-check">
            {{ html()->checkbox('etiquetas[]', in_array($etiqueta->id, old('etiquetas', [])), $etiqueta->id)->class('form-check-input')->id('etiqueta_'.$etiqueta->id) }}
            {{ html()->label($etiqueta->name, 'etiqueta_'.$etiqueta->id)->class('form-check-label') }}
        </div>
        @endforeach
        @error('etiquetas_id')
        <span class='text-danger'>{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group py-3">
        <p class="font-weight-bold">Estado:</p>
        <label>
            {{ html()->radio('status',$checked=true, $value =1)->class('form-control') }}
            Borrador
        </label>
        <label>
            {{ html()->radio('status',$checked=false, $value =2)->class('form-control') }}
            Publicado
        </label>
        <br>
        @error('status')
        <span class='text-danger'>{{$message}}</span>
        @enderror
    </div>

    <!-- * _______________________________________________      PHOTO ______________________________________________________________________________________ -->

    <div class="row">
        <div class="col">
            <div class="image-wrapper">
                <img src="{{asset('storage\CoreImages\SinPhoto.jpeg')}}" alt="" id="picture">
            </div>
        </div>
        <div class="col">
            <div class="form-group">


                {{ html()->label('Imagen que se vera en la Publicación') }}
                {{ html()->file('file')->class('form-control')}}
                 <br>
                <strong> Dimensiones de la Imagen :</strong>
                <p>Alto : 1024 px</p>
                <p>ancho : 610 px</p>
                @error('file')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- * _______________________________________________      /PHOTO ______________________________________________________________________________________ -->
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
<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
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

    // cambiar imagen
    document.getElementById("file").addEventListener('change', cambiarImagen);

    function cambiarImagen() {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
</script>
<script>
    $(document).ready(function() {
        $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    });
</script>
@stop