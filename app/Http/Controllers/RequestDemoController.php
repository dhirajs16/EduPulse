<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequestDemoStatusRequest;
use App\Services\RequestDemoService;
use App\Services\NotificationService;

class RequestDemoController extends Controller
{
    public function __construct(protected RequestDemoService $requestDemoService)
    {
    }

    public function index()
    {
        $requests = $this->requestDemoService->list();
        return view('admin.request_demos.index', compact('requests'));
    }

    public function show($id)
    {
        $requestDemo = $this->requestDemoService->find($id);
        return view('admin.request_demos.show', compact('requestDemo'));
    }

    public function updateStatus(UpdateRequestDemoStatusRequest $request, $id)
    {
        $this->requestDemoService->updateStatus($id, $request->validated()['status']);

        NotificationService::UPDATED('Request status updated successfully.');
        return redirect()->route('admin.request_demos.show', $id);
    }
}
