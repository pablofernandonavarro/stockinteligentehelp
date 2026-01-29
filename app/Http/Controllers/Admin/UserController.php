<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {

        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user)->with('message', 'Se asigno los roles coreectamente');
    }

    public function destroy(User $user)
    {

        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('message', 'Se eliminio el Usuario Corectamente');
    }

}
