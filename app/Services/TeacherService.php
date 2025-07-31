<?php

namespace App\Services;

use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherService
{
    public function __construct(protected TeacherRepositoryInterface $teacherRepo)
    {
    }

    public function list()
    {
        return $this->teacherRepo->all();
    }

    public function find($id)
    {
        return $this->teacherRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->teacherRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->teacherRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->teacherRepo->delete($id);
    }
}
