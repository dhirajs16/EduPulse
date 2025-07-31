<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Student;
use App\Models\Fee;
use App\Services\NotificationService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $transactionService)
    {
    }

    public function index()
    {
        $transactions = $this->transactionService->list();

        // To filter/search in Blade, pass students and fees for select filters if desired
        $students = Student::all();
        $fees = Fee::all();

        return view('admin.transactions.index', compact('transactions', 'students', 'fees'));
    }

    public function create()
    {
        $students = Student::all();
        $fees = Fee::all();

        return view('admin.transactions.create', compact('students', 'fees'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $this->transactionService->store($request->validated());

        NotificationService::CREATED('Transaction created successfully.');
        return redirect()->route('admin.transactions.index');
    }

    public function edit($id)
    {
        $transaction = $this->transactionService->find($id);
        $students = Student::all();
        $fees = Fee::all();

        return view('admin.transactions.edit', compact('transaction', 'students', 'fees'));
    }

    public function update(UpdateTransactionRequest $request, $id)
    {
        $this->transactionService->update($id, $request->validated());
        NotificationService::UPDATED('Transaction updated successfully.');
        return redirect()->route('admin.transactions.index');
    }

    public function destroy($id)
    {
        $this->transactionService->delete($id);
        NotificationService::DELETED('Transaction deleted successfully.');
        return redirect()->route('admin.transactions.index');
    }
}
