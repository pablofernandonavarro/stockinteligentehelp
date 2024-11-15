<div>
    @section('content_header')
        <h1 class="d-flex justify-content-center mx-auto my-auto">Clientes :</h1>
    @stop
    <div>
        @section('content_header')
            <h1 class="d-flex justify-content-center mx-auto my-auto">Preguntas frecuentes:</h1>
        @stop
        <div>

        </div>
        <div class="card">
            <div class="card-header">

                <input wire:model.live="search" type="search" class="form-control"
                    placeholder="Ingrese el nombre de la publicacion a buscar" autofocus />

            </div>
            <div>
                <!-- Botón para abrir el modal -->
                <button wire:click="crear()" class="btn btn-secondary mx-3 my-3">Agregar Cliente</button>

                <!-- Modal -->
                @if ($modal)
                    @include('livewire.admin.customercreate')
                @endif
            </div>
        </div>

        <!-- Modal -->






        @if ($customers->count())
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>email</th>
                                <th>url</th>
                                <th>Prioridad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->url }}</td>
                                    <td>{{ $customer->priority }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.customers.show', $customer->id) }}">
                                            <button class="btn btn-secondary btn-sm">Ver datos</button>
                                        </a>
                                        <button wire:click='editar({{ $customer->id }})'
                                            class="btn btn-primary btn-sm">Editar</button>

                                        <button wire:click ='eliminar({{ $customer->id }})'
                                            class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $customers->links() }}
            </div>
        @else
            <div class="card-body">
                <strong class="alert alert-danger">no existe ninguna Publicacion con ese nombre .......</strong>
            </div>

        @endif

    </div>
</div>

</div>
