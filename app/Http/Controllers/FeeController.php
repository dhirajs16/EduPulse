<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeRequest;
use App\Http\Requests\UpdateFeeRequest;
use App\Models\FeeType;
use App\Models\Grade;
use App\Services\FeeService;
use App\Services\NotificationService;

class FeeController extends Controller
{
    public function __construct(protected FeeService $feeService)
    {
    }

    public function index()
    {
        $fees = $this->feeService->list();
        $feeTypes = FeeType::all();
        $grades = Grade::all();
        return view('admin.fees.index', compact('fees', 'feeTypes', 'grades'));
    }

    public function create()
    {
        $feeTypes = FeeType::all();
        $grades = Grade::all();
        return view('admin.fees.create', compact('feeTypes', 'grades'));
    }

    public function store(StoreFeeRequest $request)
    {
        $this->feeService->store($request->validated());

        NotificationService::CREATED('Fee created successfully.');
        return redirect()->route('admin.fees.index');
    }

    public function edit($id)
    {
        $fee = $this->feeService->find($id);
        $feeTypes = FeeType::all();
        $grades = Grade::all();


        return view('admin.fees.edit', compact('fee', 'feeTypes', 'grades'));
    }

    public function update(UpdateFeeRequest $request, $id)
    {
        $this->feeService->update($id, $request->validated());

        NotificationService::UPDATED('Fee updated successfully.');
        return redirect()->route('admin.fees.index');
    }

    public function destroy($id)
    {
        $this->feeService->delete($id);

        NotificationService::DELETED('Fee deleted successfully.');
        return redirect()->route('admin.fees.index');
    }
}
