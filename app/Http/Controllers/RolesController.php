<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

use Inertia\Inertia;

class RolesController extends Controller
{
    public function index()
    {
        $data = Role::with('permissions')->withCount('users')->paginate(10);
        $all_permissions = Permission::all();
        return Inertia::render('roles/index', [
            'data' => $data,
            'all_permissions' => $all_permissions
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);

        if($role){
            if($request->input('permissions')){
                $role->syncPermissions($request->permissions);
            }

            return response()->json(['message'=>'Role has been added.']);
        }
    }

    public function show(string $id)
    {
        $role = Role::find($id);

        if($role){
            $permissions = $role->permissions->pluck('id')->toArray();
            return response()->json(['role'=>$role, 'permissions'=>$permissions]);
        }
        return response()->json(['message'=>'No Role with this ID'],404);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        if($role){
            $role->update([
                'name' => $request->name
            ]);

            if($request->input('permissions')){
                $role->syncPermissions($request->permissions);
            }

            return response()->json(['message'=>'Role has been updated.']);
        }
        return response()->json(['message'=>'No Role with this ID'],404);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);
        if($role){
            $role->delete();
            return response()->json(['message'=>'Role has been deleted.']);
        }
        return response()->json(['message'=>'No Role with this ID'],404);
    }
}

