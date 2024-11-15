<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;

class Branchshow extends Component
{
    public $branches;
    public $selectedBranch;
    public $action = 'create';
    public $showModal = false;

    public function mount()
    {
        $this->branches = Branch::all();
        $this->selectedBranch = new Branch();
    }

    public function showModal($id = null)
    {
        if ($id) {
            $this->selectedBranch = Branch::find($id);

            // Si no se encuentra la sucursal, inicializar un nuevo objeto.
            if (!$this->selectedBranch) {
                $this->selectedBranch = new Branch();
            }

            $this->action = 'edit'; // Acción de edición
        } else {
            $this->selectedBranch = new Branch(); // Inicializa un nuevo objeto Branch
            $this->action = 'create'; // Acción de creación
        }

        $this->showModal = true; // Muestra el modal
    }

    public function save()
    {
        $this->validate([
            'selectedBranch.branch_name' => 'required',
            'selectedBranch.any_desk' => 'required',
            'selectedBranch.address' => 'required',
            'selectedBranch.latitude' => 'required',
            'selectedBranch.longitude' => 'required',
        ]);

        $this->selectedBranch->save();
        $this->showModal = false;
        $this->branches = Branch::all();
    }

    public function update()
    {
        $this->validate([
            'selectedBranch.branch_name' => 'required',
            'selectedBranch.any_desk' => 'required',
            'selectedBranch.address' => 'required',
            'selectedBranch.latitude' => 'required',
            'selectedBranch.longitude' => 'required',
        ]);

        $this->selectedBranch->save();
        $this->showModal = false;
        $this->branches = Branch::all();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedBranch = new Branch();
    }

    public function render()
{
    if (is_null($this->selectedBranch)) {
        $this->selectedBranch = new Branch(); // Asegúrate de que sea un objeto válido
    }

    return view('livewire.branchshow');
}
    public function showDetails($id)
    {
        $this->selectedBranch = Branch::find($id);
        $this->action = 'show'; // Solo muestra detalles
        $this->showModal = true; // Muestra el modal
    }
}
