
@extends('admin.layouts.master')
@section('title', 'Transactions List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Transactions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">

                <div class="col-md-3">
                    <select id="studentSearch" class="form-select">
                        <option value="">Filter by Student</option>
                        @foreach ($students as $student)
                            <option value="{{ strtolower($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}">
                                {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="feeSearch" class="form-select">
                        <option value="">Filter by Fee</option>
                        @foreach ($fees as $fee)
                            <option value="{{ $fee->id }}">{{ $fee->feeType->name ?? 'N/A' }} - {{ $fee->grade->name ?? 'N/A' }} ({{ $fee->year }}/{{ $fee->month }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="date" id="paymentDateSearch" class="form-control" placeholder="Filter by Payment Date">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div
                id="transactionsData"
                data-items='{!! $transactions->map(function($tx){
                    $studentName = trim($tx->student->first_name.' '.$tx->student->middle_name.' '.$tx->student->last_name);
                    return [
                        "id" => $tx->id,
                        "student_id" => $tx->student_id,
                        "student_name" => strtolower($studentName),
                        "fee_id" => $tx->fee_id,
                        "fee_label" => $tx->fee->feeType->name ?? 'N/A' . ' - ' . ($tx->fee->grade->name ?? 'N/A') . ' (' . $tx->fee->year.'/'.$tx->fee->month . ')',
                        "amount_paid" => $tx->amount_paid,
                        "payment_date" => $tx->payment_date->format('Y-m-d'),
                        "notes" => $tx->notes ?? '',
                    ];
                })->toJson() !!}'
                style="display:none;"
            ></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Fee</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th>Notes</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container injected by JS --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.transactions.script')
@endsection
