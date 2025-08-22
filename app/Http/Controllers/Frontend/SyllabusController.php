<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Syllabus;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function subjectList() {
        // This method should return a list of subjects for the syllabus
        $subjects = Subject::all();
        return view('frontend.dashboard.syllabi.subjects', compact('subjects'));
    }


    public function syllabusDetails(Grade $grade, Subject $subject) {
        // This method should return the syllabus details for a specific subject
        $syllabi = Syllabus::where('grade_id', $grade->id)
            ->where('subject_id', $subject->id)->orderBy('chapter_number')->get();
            // dd($syllabus);
        return view('frontend.dashboard.syllabi.details', compact('subject', 'syllabi', 'grade'));
    }
}
