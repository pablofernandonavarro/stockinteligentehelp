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
                    <div class="small-box bg-info my-2">
                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-decoration-none text-white">
                            <div class="inner">
                                <h3>{{ $customer->name }}</h3>
                                <p>Prioridad: {{ $customer->priority }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </a>
                        <!-- Enlace al sitio externo dinámico del cliente -->
                        <a href="{{ Str::startsWith($customer->url, 'http') ? $customer->url : 'http://' . $customer->url }}" class="small-box-footer text-white" target="_blank" rel="noopener noreferrer">
                            Ir al sitio <i class="fas fa-arrow-circle-right"></i>
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
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
