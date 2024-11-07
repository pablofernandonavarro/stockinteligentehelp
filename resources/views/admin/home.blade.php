@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
    <h1 class="d-flex justify-content-center mx-auto my-auto">Stock Inteligente</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($customers as $customer)
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $customer->name }}</h3>
                            <p>Prioridad: {{ $customer->priority }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{$customer->url}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">Ir al sitio:<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Añadir cualquier estilo adicional si es necesario */
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
