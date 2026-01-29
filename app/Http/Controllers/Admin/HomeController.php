<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class HomeController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('admin.home',compact('customers'));

    }
}
