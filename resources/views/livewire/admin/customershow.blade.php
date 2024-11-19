<div>
    @extends('adminlte::page')

    @section('title', 'StockInteligente')

    @section('content_header')
        <h2>Datos del Cliente:<span class="text-danger"> {{$customer->name}}</span></h2>
    @stop

    @section('content')
        <div class="row">
            <div class="col-md-4">
                <x-accordion :title="'Generales'" :accordionId="'accordionGenerales'" :id="'collapseGenerales'" :expanded="'false'" >


                    <x-dynamic-input etiqueta="Nombre :" tipo="text" placeholder="Escribe tu nombre de usuario" name="name"
                        value="{{ $customer->name }}" />
                    <x-dynamic-input etiqueta="Direccion :" tipo="text" placeholder="" name="address"
                        value="{{ $customer->address }}" />
                    <x-dynamic-input etiqueta="Email :" tipo="email" placeholder="" name="email"
                        value="{{ $customer->email }}" />
                    <x-dynamic-input etiqueta="Telefono :" tipo="text" placeholder="" name="phone"
                        value="{{ $customer->phone }}" />
                    <x-dynamic-input etiqueta="URL" tipo="text" placeholder="" name="url" value="{{ $customer->url }}" />
                    <x-dynamic-input etiqueta="Prioridad" tipo="text" placeholder="" name="priority"
                        value="{{ $customer->priority }}" />
                </x-accordion>
            </div>
            <div class="col-md-4">
                <livewire:branchshow :customerId="$customer->id">
                </livewire:branchshow>
            </div>
            <div class="col-md-4">
                <x-accordion :title="'Tareas Pendientes'" :accordionId="'accordiontasks'" :id="'collapsetasks'" :expanded="'false'" >
                 <H6>HKHDK</H6>
                </x-accordion>
            </div>
        </div>

    @stop

</div>
