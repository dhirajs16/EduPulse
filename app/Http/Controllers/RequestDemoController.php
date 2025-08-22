<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestDemoRequest;
use App\Http\Requests\UpdateRequestDemoStatusRequest;
use App\Mail\RequestDemoConfirm;
use App\Models\RequestDemo;
use App\Services\RequestDemoService;
use App\Services\NotificationService;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestDemoController extends Controller
{
    public function __construct(protected RequestDemoService $requestDemoService) {}

    public function index()
    {
        $requests = $this->requestDemoService->list();

        return view('admin.request_demos.index', compact('requests'));
    }

    public function create()
    {
        return view('frontend.request_demos.create');
    }

    public function store(StoreRequestDemoRequest $request)
    {
        // dd($request->validated());
        $this->requestDemoService->store($request->validated());

        NotificationService::CREATED('Request for demo has been submitted successfully. You will be contacted soon.');
        return redirect()->route('home');
    }

    public function show($id)
    {
        $requestDemo = $this->requestDemoService->find($id);
        return view('admin.request_demos.show', compact('requestDemo'));
    }

    public function updateStatus(UpdateRequestDemoStatusRequest $request, $id)
    {
        $this->requestDemoService->updateStatus($id, $request->validated()['status']);
        if ($request->validated()['status'] === 'approved') {
            // dd(RequestDemo::find($id)->email);
            $to = RequestDemo::find($id)->email;
            $subject = 'Credentials for Free Demo';
            $msg = 'Here are your credentials...';

            Mail::to($to)->send(new RequestDemoConfirm($subject, $msg));

            NotificationService::CREATED('Your request for demo has been approved.');
        }

        // NotificationService::UPDATED('Request status updated successfully.');
        return redirect()->route('admin.request_demos.index');
    }
}
