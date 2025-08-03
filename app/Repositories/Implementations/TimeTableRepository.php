<?php

namespace App\Repositories\Implementations;

use App\Models\TimeTable;
use App\Repositories\Interfaces\TimeTableRepositoryInterface;

class TimeTableRepository implements TimeTableRepositoryInterface
{
    public function all()
    {
        return TimeTable::with(['grade', 'subject', 'teacher'])->get();
    }

    public function find($id)
    {
        return TimeTable::with(['grade', 'subject', 'teacher'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return TimeTable::create($data);
    }

    public function update($id, array $data)
    {
        $timeTable = $this->find($id);
        $timeTable->update($data);
        return $timeTable;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
