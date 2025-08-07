<?php

namespace App\Repositories\Interfaces;

interface RequestDemoRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function updateStatus(int $id, string $status);
}
