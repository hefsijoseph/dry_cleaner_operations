<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $authEmployee = Auth::guard('employee')->user();
        return view("roles.index", compact("roles", "authEmployee"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view("roles.create", compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "name" => "required",
            
        ]);

  
    //   $guard = (new \App\Models\Employee)->getGuardName(); 

        $role = Role::create([
         "name" => $request->name,
         'guard_name' => 'employee',
          ] );

        $role->syncPermissions($request->permissions);
        return redirect()->route("roles.index")
             ->with("success", "Role created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view("roles.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $role = Role::findOrFail($id);
         $permissions = Permission::all();
        return view("roles.edit", compact("role", "permissions"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            "name" => "required",
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route("roles.index")
             ->with("success", "Role updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route("roles.index")
             ->with("success", "Role deleted.");
    }
}
