<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Grade;
use App\Models\GradeTeacher;
use App\Models\Subject;
use App\Services\NotificationService;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    public function __construct(protected TeacherService $teacherService)
    {}

    public function index()
    {
        $teachers = $this->teacherService->list();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('admin.teachers.create', compact('grades', 'subjects'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $validated = $request->validated();

        $this->teacherService->store($validated);

        NotificationService::CREATED('Teacher created successfully');
        return redirect()->route('admin.teachers.index');
    }

    public function edit($id)
    {
        $teacher = $this->teacherService->find($id);

        $grades = Grade::all();
        $subjects = Subject::all();

        // For easier form population, prepare grade_subjects pairs currently assigned
        $gradeSubjects = GradeTeacher::where('teacher_id', $id)
            ->get(['grade_id', 'subject_id'])
            ->toArray();

        return view('admin.teachers.edit', compact('teacher', 'grades', 'subjects', 'gradeSubjects'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $validated = $request->validated();

        $this->teacherService->update($id, $validated);

        NotificationService::UPDATED('Teacher updated successfully');
        return redirect()->route('admin.teachers.index');
    }

    public function destroy($id)
    {
        $this->teacherService->delete($id);
        NotificationService::DELETED('Teacher deleted successfully');
        return redirect()->route('admin.teachers.index');
    }
}
