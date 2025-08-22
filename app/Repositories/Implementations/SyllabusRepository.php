<?php

namespace App\Repositories\Implementations;

use App\Models\Syllabus;
use App\Repositories\Interfaces\SyllabusRepositoryInterface;

class SyllabusRepository implements SyllabusRepositoryInterface
{
    public function all()
    {
        return Syllabus::with(['grade', 'subject'])->get();
    }

    public function find(int $id)
    {
        return Syllabus::with(['grade', 'subject'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Syllabus::create($data);
    }

    public function update(int $id, array $data)
    {
        $syllabus = $this->find($id);
        $syllabus->update($data);
        return $syllabus;
    }

    public function delete(int $id)
    {
        $syllabus = $this->find($id);
        return $syllabus->delete();
    }
}
