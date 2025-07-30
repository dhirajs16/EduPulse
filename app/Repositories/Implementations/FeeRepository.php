<?php

namespace App\Repositories\Implementations;

use App\Models\Fee;
use App\Repositories\Interfaces\FeeRepositoryInterface;

class FeeRepository implements FeeRepositoryInterface
{
    public function all()
    {
        // Eager load related feeType and grade for efficient queries
        return Fee::with(['feeType', 'grade'])->get();
    }

    public function find($id)
    {
        return Fee::with(['feeType', 'grade'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Fee::create($data);
    }

    public function update($id, array $data)
    {
        $fee = $this->find($id);
        $fee->update($data);
        return $fee;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
