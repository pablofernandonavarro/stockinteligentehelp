<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public $name, $phone, $address, $email, $priority, $url;
    public $customerId = null;
    public $modal = false;
    public $search = ""; // Campo para el término de búsqueda

    protected $queryString = ['search']; // Para mantener el término de búsqueda en la URL
    protected $paginationTheme = 'bootstrap'; // Para aplicar estilos de Bootstrap en la paginación

    public function render()
    {
        $customers = Customer::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->paginate(10); // Paginación de 10 elementos por página

        return view('livewire.admin.customers', compact('customers'))->layout('layouts.home');
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reiniciar la página al actualizar la búsqueda
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->customerId = null;
        $this->abrirModal();
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->customerId = null;
        $this->name = "";
        $this->phone = "";
        $this->address = "";
        $this->email = "";
        $this->priority = "";
        $this->url = "";
    }

    public function editar($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customerId = $id;
        $this->name = $customer->name;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->email = $customer->email;
        $this->priority = $customer->priority;
        $this->url = $customer->url;
        $this->abrirModal();
    }

    public function eliminar($id)
    {
        Customer::find($id)->delete();
    }
    public function guardar()
    {
        // Validar los datos antes de guardarlos
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'priority' => 'required|nullable|integer',
            'url' => 'nullable|url|max:255'
        ]);
        $priorityValue = $this->priority !== '' ? $this->priority : 0;
        // Si el id está vacío o no existe, será considerado un nuevo registro
        if ($this->customerId) {
            // Si existe un ID, actualizamos el registro existente
            $customer = Customer::findOrFail($this->customerId);
        } else {
            // Si no hay ID, estamos creando un nuevo cliente
            $customer = new Customer();
        }

        // Guardar o actualizar el cliente directamente
        $customer->name = $this->name;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
        $customer->email = $this->email;
        $customer->priority = $this->priority;
        $customer->url = $this->url;

        // Guardamos el cliente (si es un nuevo cliente, se inserta; si es uno existente, se actualiza)
        $customer->save();

        // Cerrar el modal y limpiar los campos
        $this->cerrarModal();
        $this->limpiarCampos();
    }
}
