@extends('adminlte::page')

@section('title', 'Preguntas Frecuentes')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Mostrar preguntas frecuentes:</h3>
        </div>
        <div class="card-body">

            <div class="mb-3">
                {{ html()->label('Pregunta', 'question')->class('form-label') }}
                <p class="form-control-plaintext">{{ $faq->question }}</p>
            </div>

            <div class="mb-3">
                {{ html()->label('Respuesta', 'answer')->class('form-label') }}
                <p class="form-control-plaintext">{{ $faq->answer }}</p>
            </div>

            <div class="mb-3 row">
                <div class="col-md-6">
                    {{ html()->label('Categoría', 'category_id')->class('form-label') }}
                    <p class="form-control-plaintext">{{ $faq->category->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    {{ html()->label('Activo', 'is_active')->class('form-label') }}
                    <p class="form-control-plaintext">{{ $faq->is_active ? 'Sí' : 'No' }}</p>
                </div>
            </div>

            <div class="mb-3">
                {{ html()->label('Prioridad', 'priority')->class('form-label') }}
                <p class="form-control-plaintext">{{ $faq->priority }}</p>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-primary">Volver</a>
            </div>

        </div>
        <div class="card-footer">
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
