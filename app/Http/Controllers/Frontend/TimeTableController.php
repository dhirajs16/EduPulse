<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\TimeTable;

class TimeTableController extends Controller
{
    public function show(Grade $grade)
    {

        $timetables = TimeTable::where('grade_id', $grade->id)->get();
        // dd($timeTables);
        return view('frontend.dashboard.time_tables.show', compact('grade', 'timetables'));
    }
}
