<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    public function __construct(protected TeacherService $teacherService)
    {
    }

    public function index()
    {
        $teachers = $this->teacherService->list();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        // Only users with user_type = 'teacher' for select input on create form
        $users = User::where('user_type', 'teacher')->get();
        $subjects = Subject::all();
        $grades = Grade::all();

        return view('admin.teachers.create', compact('users', 'subjects', 'grades'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $this->teacherService->store($data);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit($id)
    {
        $teacher = $this->teacherService->find($id);
        $users = User::where('user_type', 'teacher')->get();
        $subjects = Subject::all();
        $grades = Grade::all();
        return view('admin.teachers.edit', compact('teacher', 'users', 'subjects', 'grades'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $this->teacherService->update($id, $data);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $this->teacherService->delete($id);

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
