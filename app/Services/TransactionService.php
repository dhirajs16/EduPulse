<?php

namespace App\Services;

use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(protected TransactionRepositoryInterface $transactionRepo)
    {
    }

    public function list()
    {
        return $this->transactionRepo->all();
    }

    public function find($id)
    {
        return $this->transactionRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->transactionRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->transactionRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->transactionRepo->delete($id);
    }
}
