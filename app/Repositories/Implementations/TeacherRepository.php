<?php

namespace App\Repositories\Implementations;

use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function all()
    {
        // eager load user relationship to access user email easily
        return Teacher::with('user')->get();
    }

    public function find($id)
    {
        return Teacher::with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Teacher::create($data);
    }

    public function update($id, array $data)
    {
        $teacher = $this->find($id);
        $teacher->update($data);
        return $teacher;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
