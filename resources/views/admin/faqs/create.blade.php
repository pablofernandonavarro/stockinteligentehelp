@extends('adminlte::page')

@section('title', 'Preguntas Frecuentes')

@section('content_header')

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Crear preguntas frecuentes:</h3>
        </div>
        <div class="card-body">

            {{ html()->form('POST', route('admin.faqs.store'))->class('form-horizontal')->open() }}

            <div class="mb-3">
                {{ html()->label('Pregunta', 'question')->class('form-label') }}
                {{ html()->text('question')->class('form-control')->placeholder('Ingrese la pregunta') }}
                @error('question')
                    <span class= 'text-danger'>{{ $message }}</span>
                @enderror


                <div class="mb-3">
                    {{ html()->label('Respuesta', 'answer')->class('form-label') }}
                    {{ html()->textarea('answer')->class('form-control custom-textarea')->placeholder('Ingrese la respuesta') }}
                    @error('answer')
                        <span class= 'text-danger'>{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">

                        {{ html()->label('Categoría', 'category')->class('form-label') }}
                        {{ html()->select('category_id', $categories->pluck('name', 'id'))->class('form-control')->placeholder('Seleccione una categoría') }}
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">

                        {{ html()->label('Activo', 'is_active')->class('form-label') }}
                        {{ html()->select('is_active', [1 => 'Sí', 0 => 'No'])->class('form-control')->placeholder('Seleccione el estado') }}
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    {{ html()->label('Prioridad')->class('form-label') }}
                    {{ html()->number('priority', 'priority')->class('form-control')->placeholder('ingrese un numero para determinar la prioridad') }}

                    @error('priority')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    {{ html()->submit('Crear Pregunta Frecuente')->class('btn btn-success') }}
                </div>

                {{ html()->form()->close() }}

            </div>
            <div class="car-footer">

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
