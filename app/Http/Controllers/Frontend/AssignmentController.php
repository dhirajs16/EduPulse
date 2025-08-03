<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\GradeTeacher;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\AssignmentService;
use App\Services\NotificationService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function __construct(protected AssignmentService $assignmentService) {}

    public function index(Teacher $teacher)
    {
        // Fetch assignments for the logged-in teacher
        $assignments = Assignment::where('teacher_id', $teacher->id)
            ->with(['grade', 'subject'])
            ->get();

        return view('frontend.dashboard.assignments.index', compact('assignments', 'teacher'));
    }

    public function show(Grade $grade)
    {
        // Fetch assignments for the specific grade
        $assignments = Assignment::where('grade_id', $grade->id)
            ->with(['teacher', 'subject'])
            ->get();

        return view('frontend.dashboard.assignments.show', compact('assignments', 'grade'));
    }

    public function create(Teacher $teacher)
    {
        // Ensure the logged-in user is a teacher
        if (Auth::user()->user_type !== 'teacher') {
            abort(403, 'Unauthorized');
        }

        // Fetch grades linked with this teacher for assignment creation
        $teacher = Auth::user()->teacher;
        if (!$teacher) {
            abort(403, 'Unauthorized');
        }

        $teacher = Auth::user()->teacher;
        // Fetch grades linked with this teacher for assignment
        $gradeIds = GradeTeacher::where('teacher_id', $teacher->id)
            ->pluck('grade_id')
            ->unique();

        // Fetch subject IDs linked with this teacher
        $subjectIds = GradeTeacher::where('teacher_id', $teacher->id)
            ->pluck('subject_id')
            ->unique();

        // Grades allowed for assignment creation
        $grades = Grade::whereIn('id', $gradeIds)->get();
        $subjects = Subject::whereIn('id', $subjectIds)->get();

        return view('frontend.dashboard.assignments.create', compact('grades', 'subjects', 'teacher'));
    }

    public function store(StoreAssignmentRequest $request)
    {
        $data = $request->validated();
        $this->assignmentService->store($data);
        NotificationService::CREATED('Assignment created successfully.');
        return redirect()->route('assignments.index', $data['teacher_id']);
    }

    public function edit($id)
    {
        $assignment = $this->assignmentService->find($id);
        $teacher = Auth::user()->teacher;

        // Ensure the logged-in teacher can edit (optional authorization check)
        $canEdit = GradeTeacher::where('teacher_id', $teacher->id)
            ->where('grade_id', $assignment->grade_id)
            ->exists();

        if (!$canEdit) {
            abort(403, 'Unauthorized');
        }

        $gradeIds = GradeTeacher::where('teacher_id', $teacher->id)
            ->pluck('grade_id')
            ->unique();

        $grades = Grade::whereIn('id', $gradeIds)->get();
        $subjects = Subject::all();

        return view('frontend.dashboard.assignments.edit', compact('assignment', 'grades', 'subjects', 'teacher'));
    }

    public function update(UpdateAssignmentRequest $request, $id)
    {
        $data = $request->validated();
        $this->assignmentService->update($id, $data);
        NotificationService::UPDATED('Assignment updated successfully.');
        return redirect()->route('assignments.index', $data['teacher_id']);
    }

    public function destroy($id)
    {
        $this->assignmentService->delete($id);
        NotificationService::DELETED('Assignment deleted successfully.');
        return redirect()->route('assignments.index', ['teacher' => Auth::user()->teacher->id]);
    }
}
