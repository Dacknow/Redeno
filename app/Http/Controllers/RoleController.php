<?php

namespace App\Http\Controllers;

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

        $data = [
            'title' => 'Lista de roles',
            'roles' => $roles
        ];

        return view('admin.back.pages.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        $data = [
            'title' => 'Crear Rol',
            'permissions' => $permissions
        ];
        return view('admin.back.pages.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required'=>'Ingrese el nombre del rol'
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('success','El rol ha sido creado');

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        
        $data = [
            'title' => 'Lista de roles',
            'role' => $role,
            'permissions' => $permissions
        ];

        return view('admin.back.pages.roles.edit', $data );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required'=>'Ingrese el nombre del rol'
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        session()->flash('success','El rol ha sido actualizado');

        
        return redirect()->route('roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success','El rol ha sido eliminado');
        return redirect()->route('roles.index');
    }
}