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

                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Conexión</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $branch)
                                <tr>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td>{{ $branch->any_desk }}</td>
                                    <td>
                                        <button wire:click="showDetails({{ $branch->id }})" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                        <button wire:click="showModal({{ $branch->id }})" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-newspaper"></i> Editar
                                        </button>
                                        <button wire:click="delete({{ $branch->id }})" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No hay sucursales para este cliente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1"
        style="@if ($showModal) display: block; @else display: none; @endif" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($action === 'create')
                            Crear Sucursal
                        @elseif ($action === 'edit')
                            Editar Sucursal
                        @else
                            Detalles de la Sucursal
                        @endif
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($action === 'create' || $action === 'edit')
                        <!-- Formulario de edición o creación -->
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" wire:model="selectedBranch.branch_name">
                        </div>
                        <div class="form-group">
                            <label>Acceso Remoto:</label>
                            <input type="text" class="form-control" wire:model="selectedBranch.any_desk">
                        </div>
                        <div class="form-group">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" wire:model="selectedBranch.address">
                        </div>
                        <div class="form-group">
                            <label>Latitud:</label>
                            <input type="text" class="form-control" wire:model="selectedBranch.latitude">
                        </div>
                        <div class="form-group">
                            <label>Longitud:</label>
                            <input type="text" class="form-control" wire:model="selectedBranch.longitude">
                        </div>
                    @elseif ($action === 'show')
                        <!-- Solo muestra detalles -->
                        <p><strong>Nombre:</strong> {{ $selectedBranch?->branch_name }}</p>
                        <p><strong>Acceso Remoto:</strong> {{ $selectedBranch->any_desk }}</p>
                        <p><strong>Dirección:</strong> {{ $selectedBranch->address }}</p>
                        <p><strong>Latitud:</strong> {{ $selectedBranch->latitude }}</p>
                        <p><strong>Longitud:</strong> {{ $selectedBranch->longitude }}</p>
                        <p><strong>Creado:</strong> {{ \Carbon\Carbon::parse($selectedBranch->created_at)->format('d-m-Y') }}</p>
                        <p><strong>Actualizado:</strong> {{ \Carbon\Carbon::parse($selectedBranch->updated_at)->format('d-m-Y') }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    @if ($action === 'create')
                        <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    @elseif ($action === 'edit')
                        <button type="button" class="btn btn-primary" wire:click="update">Actualizar</button>
                    @endif
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
@stop
