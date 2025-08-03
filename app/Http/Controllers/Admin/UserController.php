<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\NotificationService;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $users = $this->userService->list();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request->validated());
        NotificationService::CREATED('User created successfully.');
        return redirect()->route('admin.users.index');
    }

    public function edit(int $id)
    {
        $user = $this->userService->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $this->userService->update($id, $request->validated());
        NotificationService::UPDATED('User updated successfully.');
        return redirect()->route('admin.users.index');
    }

    public function destroy(int $id)
    {
        $this->userService->delete($id);
        NotificationService::DELETED('User deleted successfully.');
        return redirect()->route('admin.users.index');
    }
}
