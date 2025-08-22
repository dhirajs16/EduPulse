<?php

namespace App\Repositories\Implementations;

use App\Models\RequestDemo;
use App\Repositories\Interfaces\RequestDemoRepositoryInterface;

class RequestDemoRepository implements RequestDemoRepositoryInterface
{
    public function all()
    {
        return RequestDemo::all();
    }

    public function find(int $id)
    {
        return RequestDemo::findOrFail($id);
    }

    public function create(array $data)
    {
        return RequestDemo::create($data);
    }

    public function updateStatus(int $id, string $status)
    {
        $requestDemo = $this->find($id);
        $requestDemo->status = $status;
        $requestDemo->save();
        return $requestDemo;
    }
}
