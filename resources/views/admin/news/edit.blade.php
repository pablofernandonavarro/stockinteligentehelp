@extends('adminlte::page')

@section('title', 'Editar Publicación')

@section('content_header')
    <h1 class="d-flex justify-content-center mx-auto my-auto">Editar Novedad</h1>
@stop

@section('content')
    <div class="card">
        {{-- Formulario para editar la novedad --}}
        {{ html()->form('PUT', route('admin.news.update', $news->id))->class('form-horizontal p-3')->autocomplete('off')->attributes(['enctype' => 'multipart/form-data'])->open() }}

        {{-- Campo oculto para el ID del usuario --}}
        {{ html()->hidden('user_id', auth()->user()->id) }}

        {{-- Campo para el título --}}
        <div class="form-group">
            {{ html()->label('Título de la novedad', 'title')->class('form-label') }}
            {{ html()->text('title', $news->title)->class('form-control')->placeholder('Ingrese el título de la novedad')->required() }}
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para el slug --}}
        <div class="form-group">
            {{ html()->label('Slug', 'slug')->class('form-label') }}
            {{ html()->text('slug', $news->slug)->class('form-control')->placeholder('Slug generado automáticamente')->attribute('readonly', true) }}
            @error('slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para el contenido --}}
        <div class="form-group">
            {{ html()->label('Contenido', 'content')->class('form-label') }}
            {{ html()->textarea('content', $news->content)->class('form-control')->id('content')->required() }}
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para la imagen --}}
        <div class="row">
            <div class="col">
                <div class="image-wrapper">
                    <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('storage/CoreImages/SinPhoto.jpeg') }}" alt="Previsualización" id="picture">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ html()->label('Imagen de la publicación', 'image') }}
                    {{ html()->file('image')->class('form-control')->accept('image/*') }}
                    <br>
                    <p class="mt-2"><strong>Dimensiones recomendadas:</strong></p>
                    <ul>
                        <li>Alto: 1024 px</li>
                        <li>Ancho: 610 px</li>
                    </ul>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Fecha de publicación --}}
        <div class="form-group">
            {{ html()->label('Fecha de publicación', 'published_at')->class('form-label') }}
            {{ html()->datetime('published_at', $news->published_at)->class('form-control')->placeholder('Seleccione una fecha y hora') }}
            @error('published_at')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Selección de autor --}}
        <div class="form-group">
            {{ html()->label('Seleccionar autor', 'author_id')->class('form-label') }}
            {{ html()->select('author_id', $authors, $news->author_id)->class('form-control')->required() }}
            @error('author_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Selección de categoría --}}
        <div class="form-group">
            {{ html()->label('Seleccionar categoría', 'category_id')->class('form-label') }}
            {{ html()->select('category_id', $categories, $news->category_id)->class('form-control')->required() }}
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Campo para destacar la publicación --}}
        <div class="form-group">
            <p class="font-weight-bold">¿Destacar publicación?</p>
            <div class="form-check">
                {{ html()->checkbox('is_featured', $news->is_featured)->class('form-check-input') }}
                <label class="form-check-label" for="is_featured">
                    Sí
                </label>
            </div>
            @error('is_featured')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Estado de la publicación --}}
        <div class="form-group">
            <p class="font-weight-bold">Estado:</p>
            <div class="form-check">
                {{ html()->radio('status', $news->status === 'draft', 'draft')->class('form-check-input') }}
                <label class="form-check-label" for="status_draft">
                    Borrador
                </label>
            </div>
            <div class="form-check">
                {{ html()->radio('status', $news->status === 'published', 'published')->class('form-check-input') }}
                <label class="form-check-label" for="status_published">
                    Publicado
                </label>
            </div>
            <div class="form-check">
                {{ html()->radio('status', $news->status === 'archived', 'archived')->class('form-check-input') }}
                <label class="form-check-label" for="status_archived">
                    Archivado
                </label>
            </div>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Botón de envío --}}
        <div class="form-group text-right">
            {{ html()->submit('Actualizar Publicación')->class('btn btn-primary') }}
        </div>

        {{ html()->form()->close() }}
    </div>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 10%;
            text-align: center;
        }

        .image-wrapper img {
            position: relative;
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        // Inicializar CKEditor
        ClassicEditor.create(document.querySelector("#content"))
            .catch(error => console.error(error));

        // Cambiar imagen de previsualización
        document.getElementById("image").addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById("picture").setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        // Generar slug dinámicamente
        $(document).ready(function() {
            $("#title").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@stop
