<?php

namespace App\Repositories\Implementations;

use App\Models\FeeType;
use App\Repositories\Interfaces\FeeTypeRepositoryInterface;

class FeeTypeRepository implements FeeTypeRepositoryInterface
{
    public function all()
    {
        return FeeType::all();
    }

    public function find($id)
    {
        return FeeType::findOrFail($id);
    }

    public function create(array $data)
    {
        return FeeType::create($data);
    }

    public function update($id, array $data)
    {
        $feeType = $this->find($id);
        $feeType->update($data);
        return $feeType;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
