<?php

namespace App\Services;

use App\Repositories\Interfaces\BookRepositoryInterface;

class BookService
{
    public function __construct(protected BookRepositoryInterface $bookRepo)
    {}

    public function list()
    {
        return $this->bookRepo->all();
    }

    public function find(int $id)
    {
        return $this->bookRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->bookRepo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->bookRepo->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->bookRepo->delete($id);
    }
}

