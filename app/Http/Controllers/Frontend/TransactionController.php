<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function show(Student $student) {
        $transactions = Transaction::where('student_id', $student->id)->orderBy('id', 'desc')->get();
        // dd($transactions); // Debugging line, remove in production
        $fees = Fee::where('grade_id', $student->grade_id)->get();
        return view('frontend.dashboard.transactions.show', compact('transactions', 'student', 'fees'));
    }
}

