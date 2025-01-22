<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Para manejar la paginación
use App\Models\Branch;

class Branchshow extends Component
{
    use WithPagination;

    public $customerId;
    public $branchId = null;
    public $branch_name, $address, $latitude, $longitude, $any_desk, $anydesk_password;
    public $modal = false;

    protected $paginationTheme = 'bootstrap'; // Para personalizar el estilo de la paginación

    // Reglas de validación
    protected $rules = [
        'branch_name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'any_desk' => 'nullable|string|max:255',
        'anydesk_password' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $branches = Branch::where('customer_id', $this->customerId)->paginate(10);

        return view('livewire.branchshow', [
            'branches' => $branches,
        ]);
    }

    // Mostrar el modal de creación/edición
    public function showModal()
    {
        $this->reset(['branchId', 'branch_name', 'address', 'latitude', 'longitude', 'any_desk', 'anydesk_password']);
        $this->modal = true;
    }

    // Guardar o actualizar una sucursal
    public function save()
    {
        $this->validate();

        if ($this->branchId) {
            // Actualizar sucursal existente
            $branch = Branch::find($this->branchId);

            if ($branch) {
                $branch->update([
                    'customer_id' => $this->customerId,
                    'branch_name' => $this->branch_name,
                    'address' => $this->address,
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
                    'any_desk' => $this->any_desk,
                    'anydesk_password' => $this->anydesk_password,
                ]);

                session()->flash('message', 'Sucursal actualizada con éxito.');
            } else {
                session()->flash('error', 'Sucursal no encontrada.');
            }
        } else {
            // Crear nueva sucursal
            Branch::create([
                'customer_id' => $this->customerId,
                'branch_name' => $this->branch_name,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'any_desk' => $this->any_desk,
                'anydesk_password' => $this->anydesk_password,
            ]);

            session()->flash('message', 'Sucursal creada con éxito.');
        }

        $this->modal = false;
        $this->resetPage(); // Reiniciar paginación después de guardar
    }

    // Editar una sucursal
    public function editar($id)
    {
        $branch = Branch::findOrFail($id);

        $this->branchId = $branch->id;
        $this->branch_name = $branch->branch_name;
        $this->address = $branch->address;
        $this->latitude = $branch->latitude;
        $this->longitude = $branch->longitude;
        $this->any_desk = $branch->any_desk;
        $this->anydesk_password = $branch->anydesk_password;

        $this->modal = true;
    }

    // Eliminar una sucursal con confirmación
    public function eliminar($id)
    {
        $branch = Branch::find($id);

        if ($branch) {
            $branch->delete();
            session()->flash('message', 'Sucursal eliminada con éxito.');
        } else {
            session()->flash('error', 'Sucursal no encontrada.');
        }
    }
}
