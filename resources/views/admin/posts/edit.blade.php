@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto">Editar Publicacion:</h1>
@stop

@section('content')
<div class="card">
    {!! html()->modelForm($post, 'PUT', route('admin.posts.update',$post))->class('form-horizontal p-3')->autocomplete('off')->attribute('enctype', 'multipart/form-data')->open() !!}
    @csrf
    @method('PUT')

    {{html()->hidden('user_id', auth()->user()->id) }}
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

            {{ html()->checkbox('etiquetas[]', in_array($etiqueta->id, $post->etiquetas->pluck('id')->toArray()), $etiqueta->id)
                ->class('form-check-input')
                ->id('etiqueta_'.$etiqueta->id) }}
            {{ html()->label($etiqueta->name, 'etiqueta_'.$etiqueta->id)->class('form-check-label') }}
        </div>
        @endforeach
        @error('etiquetas')
        <span class="text-danger">{{ $message }}</span>
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
        @if ($post->image)
        <div class="image-wrapper col">
            <img src="{{ Storage::url($post->image->url) }}" alt="" id="picture">
        </div>
        @else
        <div class="image-wrapper col">
            <img src="{{asset('storage\CoreImages\SinPhoto.jpeg')}}" alt="" id="picture">
        </div>
        @endif

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
        {{ html()->submit('editar Publicación')->class('btn btn-secondary float-right my-2 mx-2') }}
    </div>
</div>

{{ html()->form()->close() }}
</div>
@stop


@section('css')
<style>
    .image-wrapper {
        position: relative;
        padding-bottom: 1%;
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