<?php

namespace Lmottasin\LaravelPermissionEditor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('permissions')->get();

        return view('permission-editor::roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('permission-editor::roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles'],
            'permissions' => ['array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        $role->givePermissionTo(
            collect($request->input('permissions'))->map(
                function ($permission) {
                    return (int)$permission;
                }
            )
        );

        return redirect()->route('permission-editor.roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name', 'id');

        return view('permission-editor::roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->input('name')]);

        $role->syncPermissions(
            collect($request->input('permissions'))->map(
                function ($permission) {
                    return (int)$permission;
                }
            )
        );

        return redirect()->route('permission-editor.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('permission-editor.roles.index');
    }
}
