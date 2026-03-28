<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\PasswordUpdateRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Traits\FileUpload;

class ProfileController extends Controller
{

    use FileUpload;

    public function personalInfo(): View
    {
        $user = Auth::guard('web')->user();
        if ($user->user_type == 'student') {
            $user = $user->student;
        } elseif ($user->user_type == 'teacher') {
            $user = $user->teacher;
        }
        return view('frontend.dashboard.profile.personal_info', compact('user'));
    }

    public function editPassword(): View
    {
        $user = Auth::guard('web')->user();
        if ($user->user_type == 'student') {
            $user = $user->student;
        } elseif ($user->user_type == 'teacher') {
            $user = $user->teacher;
        }

        return view('frontend.dashboard.profile.edit_password', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = Auth::user();

        if ($request->user_type == 'student') {
            $student = $user->student;
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($student->avatar) {
                    $this->handleDeleteFile($student->avatar);
                }
                $avatarPath = $this->handleUploadFile($request->avatar);
                $student->avatar = $avatarPath;
            }
            $student->name = $request->name;
            $student->email = $request->email;
            $student->country = $request->country;
            $student->city = $request->city;
            $student->address = $request->address;
            $student->shipping_address = $request->shipping_address;
            $student->save();
        }



        NotificationService::UPDATED("Profile Updated Successfully.");


        // alternative
        // $user->update($request->only(['name', 'email', 'country', 'city', 'address']));
        return redirect()->back();
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        NotificationService::UPDATED("Password Updated Successfully.");

        return redirect()->back();
    }
}
