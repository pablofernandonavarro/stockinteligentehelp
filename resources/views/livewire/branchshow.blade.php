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



                    @if ($branches->count())
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Any Desk Id</th>

                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($branches as $branch)
                                        <tr>
                                            <td>{{ $branch->id }}</td>
                                            <td>{{ $branch->branch_name }}</td>
                                            <td>{{ $branch->any_desk }}</td>
                                            <td class="text-center">

                                                <button wire:click="editar({{ $branch->id }})"
                                                    class="btn btn-primary btn-sm">Editar</button>
                                                <button wire:click="eliminar({{ $branch->id }})"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta sucursal?')">Eliminar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $branches->links() }}
                    @else
                        <div class="alert alert-danger">No existe ninguna sucursal.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($modal)
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $branchId ? 'Editar Sucursal' : 'Crear Sucursal' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('modal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="branch_name" class="form-label">Nombre</label>
                                <input type="text" id="branch_name" class="form-control" wire:model="branch_name">
                                @error('branch_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" id="address" class="form-control" wire:model="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitud</label>
                                <input type="text" id="latitude" class="form-control" wire:model="latitude">
                                @error('latitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitud</label>
                                <input type="text" id="longitude" class="form-control" wire:model="longitude">
                                @error('longitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="any_desk" class="form-label">Any Desk</label>
                                <input type="text" id="any_desk" class="form-control" wire:model="any_desk">
                                @error('any_desk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div x-data="{ showPassword: false }">
                                <div class="mb-3">
                                    <label for="anydesk_password" class="form-label">Any Desk Password</label>
                                    <div class="input-group">
                                        <input :type="showPassword ? 'text' : 'password'" id="anydesk_password"
                                            class="form-control" wire:model="anydesk_password">
                                        <button type="button" class="btn btn-outline-secondary"
                                            @click="showPassword = !showPassword">
                                            <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                        </button>
                                    </div>
                                    @error('anydesk_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('modal', false)">Cancelar</button>
                        <button class="btn btn-primary" wire:click="save">Guardar</button>

                    </div>

                    </div>
                </div>
            </div>
    @endif
</div>

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@stop
