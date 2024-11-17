<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;

class Branchshow extends Component
{
    public
    $customer_id,
    $branch_name,
    $address,
    $latitude,
    $longitude,
    $any_desk,
    $created_at,
    $updated_at;

    public $customerId = null;
    public $modal = false;
    public $search = "";



    public function render()
    {

        $branches = Branch::all();
        return view('livewire.branchshow', compact('branches'));
    }
    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }







}
