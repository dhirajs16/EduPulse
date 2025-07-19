<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Illuminate\Log\log;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::withCount('permissions')->where('guard_name', 'admin')->get();
        return view('admin.access-mgmt.role.index', compact('roles'));
    }
    public function create(): View
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-mgmt.role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);
        $role->syncPermissions($request->permissions);
        NotificationService::CREATED($role->name . ' Role created successfully.');

        return to_route('admin.roles.index');
    }

    public function edit(Role $role): View | RedirectResponse
    {
        if($role->name === "super admin"){
            NotificationService::ERROR();
            return to_route('admin.roles.index');
        }
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-mgmt.role.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        if($role->name === "super admin"){
            NotificationService::ERROR();
            return to_route('admin.roles.index');
        }

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        NotificationService::UPDATED($role->name . ' Role updated successfully.');

        return to_route('admin.roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if($role->name === "super admin"){
            NotificationService::ERROR();
            return to_route('admin.roles.index');
        }

        try {
            DB::beginTransaction();
            // remove roles form user
            $role->users()->detach();

            // detach permissions from role
            $role->permissions()->detach();
            $role->delete();
            DB::commit();

            NotificationService::DELETED($role->name . ' role deleted successfully.');
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Failed to delete role', ['error' => $th]);
            return redirect()->route('admin.roles.index')->with('error', 'Failed to delete role.');
        }
    }
}
