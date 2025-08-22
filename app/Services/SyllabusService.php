<?php

namespace App\Services;

use App\Repositories\Interfaces\SyllabusRepositoryInterface;

class SyllabusService
{
    public function __construct(protected SyllabusRepositoryInterface $repo)
    {}

    public function list()
    {
        return $this->repo->all();
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}
