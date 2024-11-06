<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;

class Customers extends Component
{
    public $customers;
    public function render()
    { 

       $this->customers = Customer::all();
       
        return view('livewire.admin.customers')->layout('layouts.home');;
    }
}
