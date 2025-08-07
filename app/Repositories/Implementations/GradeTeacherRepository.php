<?php

namespace App\Repositories\Implementations;

use App\Models\GradeTeacher;
use App\Repositories\Interfaces\GradeTeacherRepositoryInterface;

class GradeTeacherRepository implements GradeTeacherRepositoryInterface
{
    public function all()
    {
        return GradeTeacher::with(['grade', 'teacher', 'subject'])->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return GradeTeacher::with(['grade', 'teacher', 'subject'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return GradeTeacher::create($data);
    }

    public function update($id, array $data)
    {
        $gradeTeacher = $this->find($id);
        $gradeTeacher->update($data);
        return $gradeTeacher;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
