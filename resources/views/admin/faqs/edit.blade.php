@extends('adminlte::page')

@section('title', 'Editar Pregunta Frecuente')

@section('content_header')
    <h1>Editar Pregunta Frecuente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Formulario de Edición:</h3>
        </div>
        <div class="card-body">

            {{ html()->form('PUT', route('admin.faqs.update', $faq))->class('form-horizontal')->open() }}

            <div class="mb-3">
                {{ html()->label('Pregunta', 'question')->class('form-label') }}
                {{ html()->text('question', $faq->question)->class('form-control')->placeholder('Ingrese la pregunta') }}
                @error('question')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                {{ html()->label('Respuesta', 'answer')->class('form-label') }}
                {{ html()->textarea('answer', $faq->answer)->class('form-control custom-textarea')->placeholder('Ingrese la respuesta') }}
                @error('answer')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 row">
                <div class="col-md-6">
                    {{ html()->label('Categoría', 'category_id')->class('form-label') }}
                    {{ html()->select('category_id', $categories->pluck('name', 'id'), $faq->category_id)->class('form-control')->placeholder('Seleccione una categoría') }}
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    {{ html()->label('Activo', 'is_active')->class('form-label') }}
                    {{ html()->select('is_active', [1 => 'Sí', 0 => 'No'], $faq->is_active)->class('form-control')->placeholder('Seleccione el estado') }}
                    @error('is_active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                {{ html()->label('Prioridad', 'priority')->class('form-label') }}
                {{ html()->number('priority', $faq->priority)->class('form-control')->placeholder('Ingrese un número para determinar la prioridad') }}
                @error('priority')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                {{ html()->submit('Actualizar Pregunta Frecuente')->class('btn btn-success') }}
            </div>

            {{ html()->form()->close() }}

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
