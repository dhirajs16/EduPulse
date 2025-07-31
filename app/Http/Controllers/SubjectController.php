<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Services\NotificationService;
use App\Services\SubjectService;

class SubjectController extends Controller
{
    public function __construct(protected SubjectService $subjectService)
    {
    }

    public function index()
    {
        $subjects = $this->subjectService->list();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->subjectService->store($request->validated());

        NotificationService::CREATED('Subject created successfully.');
        return redirect()->route('admin.subjects.index');
    }

    public function edit($id)
    {
        $subject = $this->subjectService->find($id);
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $this->subjectService->update($id, $request->validated());
        NotificationService::UPDATED('Subject updated successfully.');
        return redirect()->route('admin.subjects.index');
    }

    public function destroy($id)
    {
        $this->subjectService->delete($id);
        NotificationService::DELETED('Subject deleted successfully.');
        return redirect()->route('admin.subjects.index');
    }
}
