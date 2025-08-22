@extends('admin.layouts.master')
@section('title', 'Request Demo List')
@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Request Demos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request Demos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($requests->isEmpty())
                <p>No demo requests found.</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>School Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Requested At</th>
                            <th style="width: 110px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $requestDemo)
                        <tr>
                            <td>{{ $requestDemo->school_name }}</td>
                            <td>{{ $requestDemo->email }}</td>
                            <td>{{ $requestDemo->country_code }} {{ $requestDemo->phone }}</td>
                            <td>
                                <span class="badge
                                    @if ($requestDemo->status === 'pending') bg-warning
                                    @elseif ($requestDemo->status === 'approved') bg-success
                                    @elseif ($requestDemo->status === 'rejected') bg-danger
                                    @endif
                                ">
                                    {{ ucfirst($requestDemo->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($requestDemo->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.request_demos.show', $requestDemo->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
