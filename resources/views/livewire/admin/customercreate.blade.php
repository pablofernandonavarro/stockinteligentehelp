<div class="modal fade show d-block" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nuevo Cliente</h5>
                <button type="button" wire:click="cerrarModal" class="close" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="guardar">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" wire:model="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" wire:model="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" wire:model="address" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Correo Electrónico:</label>
                        <input type="email" wire:model="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Prioridad:</label>
                        <input type="number" wire:model="priority" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>URL:</label>
                        <input type="text" wire:model="url" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="cerrarModal" class="btn btn-secondary">Cancelar</button>
                <button type="submit" wire:click.prevent='guardar()' class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
