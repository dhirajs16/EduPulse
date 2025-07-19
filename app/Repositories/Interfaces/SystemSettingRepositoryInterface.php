<?php

namespace App\Repositories\Interfaces;

interface SystemSettingRepositoryInterface
{
    public function all($keySearch, $valueSearch);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
