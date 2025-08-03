<?php

namespace App\Services;

use App\Repositories\Interfaces\TimeTableRepositoryInterface;

class TimeTableService
{
    public function __construct(protected TimeTableRepositoryInterface $timeTableRepo)
    {
    }

    public function list()
    {
        return $this->timeTableRepo->all();
    }

    public function find($id)
    {
        return $this->timeTableRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->timeTableRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->timeTableRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->timeTableRepo->delete($id);
    }
}
