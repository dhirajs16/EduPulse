<?php

namespace App\Services;

use App\Repositories\Interfaces\FeeRepositoryInterface;

class FeeService
{
    public function __construct(protected FeeRepositoryInterface $feeRepo)
    {
    }

    public function list()
    {
        return $this->feeRepo->all();
    }

    public function find($id)
    {
        return $this->feeRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->feeRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->feeRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->feeRepo->delete($id);
    }
}
