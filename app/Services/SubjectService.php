<?php

namespace App\Services;

use App\Repositories\Interfaces\SubjectRepositoryInterface;

class SubjectService
{
    public function __construct(protected SubjectRepositoryInterface $subjectRepo)
    {
    }

    public function list()
    {
        return $this->subjectRepo->all();
    }

    public function find($id)
    {
        return $this->subjectRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->subjectRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->subjectRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->subjectRepo->delete($id);
    }
}
