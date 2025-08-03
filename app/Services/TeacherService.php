<?php

namespace App\Services;

use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherService
{
    public function __construct(protected TeacherRepositoryInterface $repo)
    {
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
