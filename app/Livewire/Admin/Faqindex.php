<?php

namespace App\Livewire\Admin;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;

class Faqindex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search = "";

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $faqs = Faq::orderBy("priority", "asc")
        ->where(function($query) {
            $query->where('question', 'like', '%' . $this->search . '%')
                  ->orWhere('answer', 'like', '%' . $this->search . '%');
        })
        ->paginate(10);
        return view('livewire.admin.faqindex', compact('faqs'))
        ->layout('layouts.home');
    }

}
