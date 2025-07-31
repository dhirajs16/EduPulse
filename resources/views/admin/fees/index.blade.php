@extends('admin.layouts.master')
@section('title', 'Fees List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fees</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fees</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.fees.create') }}" class="btn btn-primary radius-30" style="background-color: #244960"><i class="bx bxs-plus-square"></i>Add New Fee</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">

                <div class="col-md-3">
                    <select id="feeTypeSearch" class="form-select">
                        <option value="">Filter by Fee Type</option>
                        @foreach ($feeTypes as $feeType)
                            <option value="{{ strtolower($feeType->name) }}">{{ $feeType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="gradeSearch" class="form-select">
                        <option value="">Filter by Grade</option>
                        @foreach ($grades as $grade)
                            <option value="{{ strtolower($grade->name) }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" id="yearSearch" class="form-control" placeholder="Search by Year" min="1900" max="{{ date('Y') + 5 }}">
                </div>

                <div class="col-md-2">
                    <input type="number" id="monthSearch" class="form-control" placeholder="Search by Month (1-12)" min="1" max="12">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30" style="background-color: #244960">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div
                id="feesData"
                data-items='{!! $fees->map(function($fee){
                    return [
                        "id" => $fee->id,
                        "fee_type" => strtolower($fee->feeType->name ?? ''),
                        "fee_type_name" => $fee->feeType->name ?? '',
                        "grade" => strtolower($fee->grade->name ?? ''),
                        "grade_name" => $fee->grade->name ?? '',
                        "amount" => $fee->amount,
                        "year" => $fee->year,
                        "month" => $fee->month,
                        "created_at" => $fee->created_at ? $fee->created_at->format('Y-m-d') : null,
                    ];
                })->toJson() !!}'
                style="display:none;">
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fee Type</th>
                            <th>Grade</th>
                            <th>Amount</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Created At</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container will be injected by JS --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.fees.script')
@endsection
