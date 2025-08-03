<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\TimeTableService;

class TimeTableController extends Controller
{
    public function __construct(protected TimeTableService $timeTableService)
    {
    }

    public function index()
    {
        $timeTables = $this->timeTableService->list();

        // For filtering inputs
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('admin.time_tables.index', compact('timeTables', 'grades', 'subjects', 'teachers'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('admin.time_tables.create', compact('grades', 'subjects', 'teachers'));
    }

    public function store(StoreTimeTableRequest $request)
    {
        $this->timeTableService->store($request->validated());

        return redirect()->route('admin.time-tables.index')->with('success', 'Timetable entry created successfully.');
    }

    public function edit($id)
    {
        $timeTable = $this->timeTableService->find($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('admin.time_tables.edit', compact('timeTable', 'grades', 'subjects', 'teachers'));
    }

    public function update(UpdateTimeTableRequest $request, $id)
    {
        $this->timeTableService->update($id, $request->validated());

        return redirect()->route('admin.time-tables.index')->with('success', 'Timetable entry updated successfully.');
    }

    public function destroy($id)
    {
        $this->timeTableService->delete($id);

        return redirect()->route('admin.time-tables.index')->with('success', 'Timetable entry deleted successfully.');
    }
}
