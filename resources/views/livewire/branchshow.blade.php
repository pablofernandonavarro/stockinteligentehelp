<div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                    Sucursales
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div>
                        <button wire:click="showModal()" class="btn btn-success btn-sm mb-3">Crear Sucursal</button>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if ($branches->count())
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>latitud</th>
                            <th>longitud</th>
                            <th>Any Desk Id</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $branch->id }}</td>
                                <td>{{ $branch->branch_name }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->latitude }}</td>
                                <td>{{ $branch->longitude }}</td>
                                <td>{{ $branch->any_desk }}</td>

                                <td class="text-center">
                                    <a href="#">
                                        <button class="btn btn-secondary btn-sm">Ver datos</button>
                                    </a>
                                    <button wire:click='editar({{ $branch->id }})'
                                        class="btn btn-primary btn-sm">Editar</button>

                                    <button wire:click ='eliminar({{ $branch->id }})'
                                        class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card-body">
            <strong class="alert alert-danger">no existe ninguna Publicacion con ese nombre .......</strong>
        </div>

    @endif

</div>




@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stop
