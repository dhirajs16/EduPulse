<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUser\StoreRoleUserRequest;
use App\Http\Requests\Admin\RoleUser\UpdateRoleUserRequest;
use App\Models\Admin;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::all();
        return view('admin.access-mgmt.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.access-mgmt.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleUserRequest $request): RedirectResponse
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        // Assign Role
        $admin->assignRole($request->role);
        NotificationService::CREATED("User Created.");

        return redirect()->route('admin.role-users.index');
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
    public function edit(Admin $role_user): View | RedirectResponse
    {
        // dd($role_user->name);
        if ($role_user->name === "super admin") {
            NotificationService::ERROR();
            return to_route('admin.role-users.index');
        }

        $roles = Role::all();
        $admin = $role_user;
        return view('admin.access-mgmt.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleUserRequest $request, Admin $role_user): RedirectResponse
    {
        if ($role_user->name === "super admin") {
            NotificationService::ERROR();
            return to_route('admin.role-users.index');
        }

        $admin = $role_user;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->has('password') && $request->filled('password')) $admin->password = bcrypt($request->password);
        $admin->save();

        // Assign Role
        $admin->assignRole($request->role);
        NotificationService::UPDATED("User ". $admin->name. " Updated Successfully.");

        return to_route('admin.role-users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $role_user): RedirectResponse
    {
        if ($role_user->name === "super admin") {
            NotificationService::ERROR();
            return to_route('admin.role-users.index');
        }


        foreach ($role_user->getRoleNames() as $role) {
            $role_user->removeRole($role);
        }
        $role_user->delete();

        NotificationService::DELETED();
        return to_route('admin.role-users.index');
    }
}
