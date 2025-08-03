<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepo) {}

    public function list()
    {
        return $this->userRepo->all();
    }

    public function find(int $id)
    {
        return $this->userRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->userRepo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->userRepo->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->userRepo->delete($id);
    }
}
