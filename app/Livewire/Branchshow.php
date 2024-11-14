<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;
class Branchshow extends Component
{
    public $customerId;

    public function render()
    {
        // Utiliza el modelo Branch para hacer la consulta a la base de datos
        $branches = Branch::where('customer_id', $this->customerId)->get();

        // Retorna la vista de Livewire con las sucursales
        return view('livewire.branchshow', compact('branches'));
    }
}
