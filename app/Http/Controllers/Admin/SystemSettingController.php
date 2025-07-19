<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemSetting\StoreSystemSettingRequest;
use App\Http\Requests\SystemSetting\UpdateSystemSettingRequest;
use App\Services\SystemSettingService;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function __construct(protected SystemSettingService $systemSettingService) {}

    public function index(Request $request)
    {
        $keySearch = $request->input('keySearch', '');
        $valueSearch = $request->input('valueSearch', '');
        $systemSettings = $this->systemSettingService->list($keySearch, $valueSearch);


        if ($request->ajax()) {
            return view('admin.systemSetting.partials.table', compact('systemSettings'))->render();
        }


        return view('admin.systemSetting.index', compact('systemSettings'));
    }


    public function create()
    {
        return view('admin.systemSetting.create');
    }

    public function store(StoreSystemSettingRequest $request)
    {
        $this->systemSettingService->store($request->validated());
        return redirect()->route('admin.system-settings.index')->with('success', 'System Setting created');
    }




    public function edit($id)
    {
        $systemSetting = $this->systemSettingService->find($id);
        return view('admin.systemSetting.create', compact('systemSetting'));
    }




    public function update(UpdateSystemSettingRequest $request, $id)
    {
        $this->systemSettingService->update($id, $request->validated());
        return redirect()->route('admin.system-settings.index')->with('success', 'System Setting updated');
    }




    public function destroy($id)
    {
        $this->systemSettingService->delete($id);
        return redirect()->route('admin.system-settings.index')->with('success', 'System Setting deleted');
    }
}
