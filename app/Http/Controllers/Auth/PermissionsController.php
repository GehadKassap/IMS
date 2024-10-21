<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page,$itemsPerPage = 10)
    {
        return response()->json(Permission::with('roles')->paginate($itemsPerPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
       
        return response()->json(['message'=>'Permission has been added.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        if($permission){
            return response()->json($permission);
        }
        return response()->json(['message'=>'No Permission with this ID'],404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);
        if($permission){
            $permission->update([
                'name' => $request->name
            ]);

            return response()->json(['message'=>'Permission has been updated.']);
        }
        return response()->json(['message'=>'No Permission with this ID'],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if($permission){
            $permission->delete();
            return response()->json(['message'=>'Permission has been deleted.']);
        }
        return response()->json(['message'=>'No Permission with this ID'],404);
    }

    public function all()
    {
        return response()->json(Permission::all());
    }
}
