<?php

namespace App\Services;

use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentService
{
    public function __construct(protected StudentRepositoryInterface $studentRepo)
    {
    }

    public function list()
    {
        return $this->studentRepo->all();
    }

    public function find($id)
    {
        return $this->studentRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->studentRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->studentRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->studentRepo->delete($id);
    }
}
