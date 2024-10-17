<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Role $roles)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.roles.create', compact('roles', 'permissions'))->with('info', 'Role creado con exíto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index', $role)->with('info', 'Role creado con exíto');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {  
        
        $request->validate([
            'name' => 'required'
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);


        return redirect()->route('admin.roles.index', $role)->with('info', 'Role creado con exíto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('info','El Rol se eliminó con exíto');
    }
}
