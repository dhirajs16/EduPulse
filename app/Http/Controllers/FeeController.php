<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeRequest;
use App\Http\Requests\UpdateFeeRequest;
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
        $grades = Grade::all();
        return view('admin.fees.index', compact('fees', 'grades'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('admin.fees.create', compact('grades'));
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
        $grades = Grade::all();

        return view('admin.fees.edit', compact('fee', 'grades'));
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
