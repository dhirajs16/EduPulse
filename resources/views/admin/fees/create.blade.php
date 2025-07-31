@extends('admin.layouts.master')
@section('title', 'Add Fee')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fees</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Fee</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.fees.index') }}" class="btn btn-primary radius-30" style="background-color: #244960">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add Fee</h5>
            <hr />
            <form action="{{ route('admin.fees.store') }}" method="POST">
                @csrf

                <div class="form-body mt-4">
                    <div class="row">

                        <div class="col-lg-6 mb-3">
                            <label for="fee_type_id" class="form-label">Fee Type <span class="text-danger">*</span></label>
                            <select name="fee_type_id" id="fee_type_id" class="form-select @error('fee_type_id') is-invalid @enderror" required>
                                <option value="">Select Fee Type</option>
                                @foreach ($feeTypes as $feeType)
                                    <option value="{{ $feeType->id }}" {{ old('fee_type_id') == $feeType->id ? 'selected' : '' }}>
                                        {{ $feeType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fee_type_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="grade_id" class="form-label">Grade <span class="text-danger">*</span></label>
                            <select name="grade_id" id="grade_id" class="form-select @error('grade_id') is-invalid @enderror" required>
                                <option value="">Select Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grade_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                            @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                            <input type="number" min="1900" max="{{ date('Y') + 5 }}" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', date('Y')) }}" required>
                            @error('year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="month" class="form-label">Month <span class="text-danger">*</span></label>
                            <input type="number" min="1" max="12" name="month" id="month" class="form-control @error('month') is-invalid @enderror" value="{{ old('month', date('n')) }}" required>
                            @error('month')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="border border-3 p-4 rounded">
                        <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960">Add Fee</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
