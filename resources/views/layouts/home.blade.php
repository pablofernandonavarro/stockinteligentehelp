@extends('adminlte::page')

@section('title', 'StockInteligente')

@section('content_header')
<h1 class="d-flex justify-content-center mx-auto my-auto"></h1>
@stop

@section('content')
<main>
    {{ $slot }}
</main>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop
