<?php

namespace App\Services;

use App\Repositories\Interfaces\FeeTypeRepositoryInterface;

class FeeTypeService
{
    public function __construct(protected FeeTypeRepositoryInterface $feeTypeRepo)
    {
    }

    public function list()
    {
        return $this->feeTypeRepo->all();
    }

    public function find($id)
    {
        return $this->feeTypeRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->feeTypeRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->feeTypeRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->feeTypeRepo->delete($id);
    }
}
