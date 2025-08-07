<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Transaction;
use App\Services\NotificationService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $transactionService)
    {
    }

    public function index(Student $student)
    {
        $transactions = $this->transactionService->list($student);

        $fees = Fee::where('grade_id', $student->grade_id)->orderBy('id', 'desc')->get();

        return view('admin.transactions.index', compact('transactions', 'student', 'fees'));
    }




    public function create(Student $student)
    {
        $fees = Fee::where('grade_id', $student->grade_id)->get();

        return view('admin.transactions.create', compact('student', 'fees'));
    }

    public function store(StoreTransactionRequest $request, Student $student)
    {
        $this->transactionService->store($request->validated());

        NotificationService::CREATED('Transaction created successfully.');
        return redirect()->route('admin.transactions.index', $student->id);
    }

    public function edit(Student $student, Transaction $transaction)
    {
        $transaction = $this->transactionService->find($transaction->id);
        $fees = Fee::where('grade_id', $student->grade_id)->get();

        return view('admin.transactions.edit', compact('transaction', 'student', 'fees'));
    }

    public function update(UpdateTransactionRequest $request, Student $student, Transaction $transaction)
    {
        $this->transactionService->update($transaction->id, $request->validated());
        NotificationService::UPDATED('Transaction updated successfully.');
        return redirect()->route('admin.transactions.index', $student->id);
    }

    public function destroy(Student $student, Transaction $transaction)
    {
        $this->transactionService->delete($transaction->id);
        NotificationService::DELETED('Transaction deleted successfully.');
        return redirect()->route('admin.transactions.index', $student->id);
    }
}
