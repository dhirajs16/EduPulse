<?php
namespace App\Services;


use App\Repositories\Interfaces\SystemSettingRepositoryInterface;

class SystemSettingService
{
    public function __construct(protected SystemSettingRepositoryInterface $systemSettingRepo) {}


    public function list($keySearch, $valueSearch)
    {
        return $this->systemSettingRepo->all($keySearch, $valueSearch);
    }


    public function store(array $data)
    {
        return $this->systemSettingRepo->create($data);
    }


    public function update($id, array $data)
    {
        return $this->systemSettingRepo->update($id, $data);
    }


    public function delete($id)
    {
        return $this->systemSettingRepo->delete($id);
    }


    public function find($id)
    {
        return $this->systemSettingRepo->find($id);
    }
}
