@extends('admin.layouts.master')
@section('title', 'Add Transaction')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Transactions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Transaction</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary radius-30" style="background-color: #244960;">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add Transaction</h5>
            <hr />
            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="student_id" class="form-label">Student <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="fee_id" class="form-label">Fee <span class="text-danger">*</span></label>
                            <select name="fee_id" id="fee_id" class="form-select @error('fee_id') is-invalid @enderror" required>
                                <option value="">Select Fee</option>
                                @foreach ($fees as $fee)
                                    <option value="{{ $fee->id }}" {{ old('fee_id') == $fee->id ? 'selected' : '' }}>
                                        {{ $fee->feeType->name ?? 'N/A' }} - {{ $fee->grade->name ?? 'N/A' }} ({{ $fee->year }}/{{ $fee->month }})
                                    </option>
                                @endforeach
                            </select>
                            @error('fee_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="amount_paid" class="form-label">Amount Paid <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="amount_paid" id="amount_paid" class="form-control @error('amount_paid') is-invalid @enderror" value="{{ old('amount_paid') }}" required>
                            @error('amount_paid')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="payment_date" class="form-label">Payment Date <span class="text-danger">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date') }}" required>
                            @error('payment_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="border border-3 p-4 rounded">
                        <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960;">Add Transaction</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
