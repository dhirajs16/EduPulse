<?php

namespace App\Services;

use App\Repositories\Interfaces\RequestDemoRepositoryInterface;

class RequestDemoService
{
    public function __construct(protected RequestDemoRepositoryInterface $requestDemoRepo)
    {
    }

    public function list()
    {
        return $this->requestDemoRepo->all();
    }

    public function find($id)
    {
        return $this->requestDemoRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->requestDemoRepo->create($data);
    }

    public function updateStatus($id, string $status)
    {
        return $this->requestDemoRepo->updateStatus($id, $status);
    }
}
