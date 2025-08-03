<?php

namespace App\Services;

use App\Repositories\Interfaces\AssignmentRepositoryInterface;

class AssignmentService
{
  public function __construct(protected AssignmentRepositoryInterface $assignmentRepo) {}

  public function list()
  {
    return $this->assignmentRepo->all();
  }

  public function find($id)
  {
    return $this->assignmentRepo->find($id);
  }

  public function store(array $data)
  {
    return $this->assignmentRepo->create($data);
  }

  public function update($id, array $data)
  {
    return $this->assignmentRepo->update($id, $data);
  }

  public function delete($id)
  {
    return $this->assignmentRepo->delete($id);
  }

  // Optional: list assignments for specific teacher & grade
  public function listByTeacherAndGrade(int $teacherId, int $gradeId)
  {
    return $this->assignmentRepo->listByTeacherAndGrade($teacherId, $gradeId);
  }
}
