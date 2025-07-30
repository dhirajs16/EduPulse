<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeTypeRequest;
use App\Http\Requests\UpdateFeeTypeRequest;
use App\Services\FeeTypeService;
use App\Services\NotificationService;

class FeeTypeController extends Controller
{
    public function __construct(protected FeeTypeService $feeTypeService)
    {
    }

    public function index()
    {
        $feeTypes = $this->feeTypeService->list();
        return view('fee_types.index', compact('feeTypes'));
    }

    public function create()
    {
        return view('fee_types.create');
    }

    public function store(StoreFeeTypeRequest $request)
    {
        $this->feeTypeService->store($request->validated());

        NotificationService::CREATED('Fee Type created successfully.');
        return redirect()->route('admin.fee-types.index');
    }

    public function edit($id)
    {
        $feeType = $this->feeTypeService->find($id);
        return view('fee_types.edit', compact('feeType'));
    }

    public function update(UpdateFeeTypeRequest $request, $id)
    {
        $this->feeTypeService->update($id, $request->validated());

        NotificationService::UPDATED('Fee Type updated successfully.');
        return redirect()->route('admin.fee-types.index')->with('success', );
    }

    public function destroy($id)
    {
        $this->feeTypeService->delete($id);

        NotificationService::DELETED('Fee Type deleted successfully.');
        return redirect()->route('admin.fee-types.index');
    }
}
