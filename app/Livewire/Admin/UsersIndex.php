<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;
    protected $paginationTheme = 'bootstrap';

    // Este método debe coincidir con el nombre de la propiedad search
    public function updatingSearch()
    {
        $this->resetPage(); // Esto reinicia la paginación cuando se actualiza el campo de búsqueda
    }

    public function render()
    {
        // Realiza la búsqueda de usuarios
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
            ->orwhere('email', 'LIKE', '%' . $this->search . '%')
            ->paginate();
  
        return view('livewire.admin.users-index', compact('users'));
    }
}
