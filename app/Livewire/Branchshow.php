<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;

class Branchshow extends Component
{
    public $customerId;
    public $branchId = null;
    public $branch_name, $address, $latitude, $longitude, $any_desk, $anydesk_password;
    public $modal = false;

    // Reglas de validación
    protected $rules = [
        'branch_name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'any_desk' => 'nullable|string|max:255',
        'anydesk_password' => 'nullable|string|max:255',
    ];

    public function render()
    {
        // Usamos paginate() para obtener la paginación adecuada
        $branches = Branch::where('customer_id', $this->customerId)->paginate(10);
        return view('livewire.branchshow', ['branches' => $branches]);
    }

    // Mostrar el modal de creación/edición de sucursal
    public function showModal()
    {
        $this->reset(['branchId', 'branch_name', 'address', 'latitude', 'longitude', 'any_desk', 'anydesk_password']);
        $this->modal = true;
    }

    // Guardar o actualizar la sucursal
    public function save()
    {
        $this->validate();

        if ($this->branchId) {
            // Si existe branchId, actualizar
            Branch::find($this->branchId)->update([
                'customer_id' => $this->customerId,
                'branch_name' => $this->branch_name,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'any_desk' => $this->any_desk,
                'anydesk_password' => $this->anydesk_password,
            ]);
            $message = 'Sucursal actualizada.';
        } else {
            // Si no existe branchId, crear nueva sucursal
            Branch::create([
                'customer_id' => $this->customerId,
                'branch_name' => $this->branch_name,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'any_desk' => $this->any_desk,
                'anydesk_password' => $this->anydesk_password,
            ]);
            $message = 'Sucursal creada.';
        }

        // Cerrar el modal y mostrar mensaje
        $this->modal = false;
        session()->flash('message', $message);
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

        // Mostrar modal para editar
        $this->modal = true;
    }

    // Eliminar una sucursal con confirmación
    public function eliminar($id)
    {

        $branch = Branch::find($id);

        if ($branch) {
            $branch->delete();
            session()->flash('message', 'Sucursal eliminada con éxito.');

            $this->branches = Branch::all();
        } else {
            session()->flash('error', 'Sucursal no encontrada.');
        }
    }
}
