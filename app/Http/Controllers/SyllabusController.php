<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSyllabusRequest;
use App\Http\Requests\UpdateSyllabusRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Services\NotificationService;
use App\Services\SyllabusService;

class SyllabusController extends Controller
{
    public function __construct(protected SyllabusService $service)
    {}

    public function index()
    {
        $syllabi = $this->service->list();
        return view('admin.syllabi.index', compact('syllabi'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('admin.syllabi.create', compact('grades', 'subjects'));
    }

    public function store(StoreSyllabusRequest $request)
    {
        $this->service->store($request->validated());
        NotificationService::CREATED('Syllabus created successfully.');
        return redirect()->route('admin.syllabi.index');
    }

    public function show(int $id)
    {
        $syllabus = $this->service->find($id);
        return view('admin.syllabi.show', compact('syllabus'));
    }

    public function edit(int $id)
    {
        $syllabus = $this->service->find($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('admin.syllabi.edit', compact('syllabus', 'grades', 'subjects'));
    }

    public function update(UpdateSyllabusRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());
        NotificationService::UPDATED('Syllabus updated successfully.');
        return redirect()->route('admin.syllabi.index');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        NotificationService::DELETED('Syllabus deleted successfully.');
        return redirect()->route('admin.syllabi.index');
    }
}
