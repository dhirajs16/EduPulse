<?php


namespace App\Repositories\Implementations;


use App\Models\SystemSetting;
use App\Repositories\Interfaces\SystemSettingRepositoryInterface;

class SystemSettingRepository implements SystemSettingRepositoryInterface
{
    public function all($keySearch, $valueSearch)
    {
        return SystemSetting::query()
            ->when($keySearch, fn($q, $search)
            => $q->where('key', 'ILIKE', "%{$search}%"))
            ->when($valueSearch, fn($q, $search)
            => $q->where('value', 'ILIKE', "%{$search}%"))
            ->paginate(8);
    }


    public function find($id)
    {
        return SystemSetting::findOrFail($id);
    }




    public function create(array $data)
    {
        return SystemSetting::create($data);
    }




    public function update($id, array $data)
    {
        $systemSetting = $this->find($id);
        $systemSetting->update($data);
        return $systemSetting;
    }




    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
