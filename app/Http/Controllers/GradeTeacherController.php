<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeTeacherRequest;
use App\Http\Requests\UpdateGradeTeacherRequest;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use App\Services\GradeTeacherService;
use App\Services\NotificationService;

class GradeTeacherController extends Controller
{
    public function __construct(protected GradeTeacherService $gradeTeacherService)
    {
    }

    public function index()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $gradeTeachers = $this->gradeTeacherService->list();
        return view('admin.grade_teachers.index', compact('gradeTeachers', 'grades', 'teachers', 'subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('admin.grade_teachers.create', compact('grades', 'teachers', 'subjects'));
    }

    public function store(StoreGradeTeacherRequest $request)
    {
        $this->gradeTeacherService->store($request->validated());

        NotificationService::CREATED('Grade Teacher assignment created successfully.');
        return redirect()->route('admin.grade_teachers.index');
    }

    public function edit($id)
    {
        $gradeTeacher = $this->gradeTeacherService->find($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin.grade_teachers.edit', compact('gradeTeacher', 'grades', 'teachers', 'subjects'));
    }

    public function update(UpdateGradeTeacherRequest $request, $id)
    {
        $this->gradeTeacherService->update($id, $request->validated());

        NotificationService::UPDATED('Grade Teacher assignment updated successfully.');
        return redirect()->route('admin.grade_teachers.index');
    }

    public function destroy($id)
    {
        $this->gradeTeacherService->delete($id);

        NotificationService::DELETED('Grade Teacher assignment deleted successfully.');
        return redirect()->route('admin.grade_teachers.index');
    }
}
