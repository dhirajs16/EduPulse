<?php

namespace App\Repositories\Implementations;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function all()
    {
        return Student::with(['user', 'grade'])->get();
    }

    public function find($id)
    {
        return Student::with(['user', 'grade'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update($id, array $data)
    {
        $student = $this->find($id);
        $student->update($data);
        return $student;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}

