@extends('admin.layouts.master')
@section('title', 'Request Demo Details')
@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Request Demo</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.request_demos.index') }}">Request Demos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.request_demos.index') }}" class="btn btn-primary radius-30" style="background-color: #244960">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Request Demo Details</h5>
            <div class="mb-3"><strong>School Name:</strong> {{ $requestDemo->school_name }}</div>
            <div class="mb-3"><strong>Email:</strong> {{ $requestDemo->email }}</div>
            <div class="mb-3"><strong>Phone:</strong> {{ $requestDemo->country_code }} {{ $requestDemo->phone }}</div>
            <div class="mb-3"><strong>Message:</strong> {!! nl2br(e($requestDemo->message ?? '-')) !!}</div>
            <div class="mb-4"><strong>Current Status:</strong>
                <span class="badge
                    @if ($requestDemo->status === 'pending') bg-warning
                    @elseif ($requestDemo->status === 'approved') bg-success
                    @elseif ($requestDemo->status === 'rejected') bg-danger
                    @endif
                ">
                    {{ ucfirst($requestDemo->status) }}
                </span>
            </div>

            <form action="{{ route('admin.request_demos.updateStatus', $requestDemo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 col-md-4">
                    <label for="status" class="form-label">Change Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ $requestDemo->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $requestDemo->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $requestDemo->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
