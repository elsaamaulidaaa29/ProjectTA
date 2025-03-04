<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create-permission')->only(['create', 'store']);
        $this->middleware('check.permission:view-permission')->only('index');
        $this->middleware('check.permission:edit-permission')->only(['edit', 'update']);
        $this->middleware('check.permission:delete-permission')->only(['destroy']);
    }

    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->get();

        return view('admins.permission.index', [
            'permissions' => $permissions

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name'],
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Permissions created succesfully.');

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admins.permission.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Permission updated successfully.');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            Alert::success('Success', 'Permission deleted successfully.');
        } else {
            Alert::error('Error', 'Permission not found.');
        }

        return redirect()->route('permissions.index');
    }
}
