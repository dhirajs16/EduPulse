<?php

namespace App\Services;

use App\Repositories\Interfaces\GradeTeacherRepositoryInterface;

class GradeTeacherService
{
    public function __construct(protected GradeTeacherRepositoryInterface $gradeTeacherRepo)
    {
    }

    public function list()
    {
        return $this->gradeTeacherRepo->all();
    }

    public function find($id)
    {
        return $this->gradeTeacherRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->gradeTeacherRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->gradeTeacherRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->gradeTeacherRepo->delete($id);
    }
}
