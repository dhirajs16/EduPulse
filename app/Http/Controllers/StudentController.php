<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Grade;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\StudentService;

class StudentController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
    }

    public function index()
    {
        $students = $this->studentService->list();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $users = User::where('user_type', 'student')->get();
        $grades = Grade::all();
        return view('students.create', compact('users', 'grades'));
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        // Optional: handle avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $this->studentService->store($data);

        NotificationService::CREATED('Student created successfully.');
        return redirect()->route('admin.students.index');
    }

    public function edit($id)
    {
        $student = $this->studentService->find($id);
        $users = User::where('user_type', 'student')->get();
        $grades = Grade::all();

        return view('students.edit', compact('student', 'users', 'grades'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $this->studentService->update($id, $data);
        NotificationService::UPDATED('Student updated successfully.');
        return redirect()->route('admin.students.index');
    }

    public function destroy($id)
    {
        $this->studentService->delete($id);

        NotificationService::DELETED('Student deleted successfully.');
        return redirect()->route('admin.students.index');
    }
}
