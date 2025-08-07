<?php

namespace App\Repositories\Implementations;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all($student)
    {
        // Eager load fee and student for listing
        return Transaction::with(['student', 'fee'])->where('student_id', $student->id)->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return Transaction::with(['student', 'fee'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update($id, array $data)
    {
        $transaction = $this->find($id);
        $transaction->update($data);
        return $transaction;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
