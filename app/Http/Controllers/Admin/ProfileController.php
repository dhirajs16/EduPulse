<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        return view('admin.profile.index');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar) {
                $this->handleDeleteFile($admin->avatar);
            }
            $avatarPath = $this->handleUploadFile($request->file('avatar'));
            $admin->avatar = $avatarPath;
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        NotificationService::UPDATED("Admin Profile Updated Successfully.");

        return redirect()->back();
    }


    public function updatePassword(PasswordUpdateRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->password = bcrypt($request->new_password);
        $admin->save();
        NotificationService::UPDATED("Password Updated Successfully.");

        return redirect()->back();
    }
}
