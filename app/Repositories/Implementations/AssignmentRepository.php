<?php

namespace App\Repositories\Implementations;

use App\Models\Assignment;
use App\Repositories\Interfaces\AssignmentRepositoryInterface;

class AssignmentRepository implements AssignmentRepositoryInterface
{
  public function all()
  {
    return Assignment::with(['teacher', 'grade', 'subject'])->get();
  }

  public function find($id)
  {
    return Assignment::with(['teacher', 'grade', 'subject'])->findOrFail($id);
  }

  public function create(array $data)
  {
    return Assignment::create($data);
  }

  public function update($id, array $data)
  {
    $assignment = $this->find($id);
    $assignment->update($data);
    return $assignment;
  }

  public function delete($id)
  {
    return $this->find($id)->delete();
  }

  public function listByTeacherAndGrade(int $teacherId, int $gradeId)
  {
    return Assignment::where('teacher_id', $teacherId)
      ->where('grade_id', $gradeId)
      ->with(['subject'])
      ->get();
  }
}
