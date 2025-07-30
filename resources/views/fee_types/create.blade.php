@extends('admin.layouts.master')
@section('title', 'Add Fee Type')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fee Types</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Fee Type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.fee-types.index') }}" class="btn btn-primary radius-30" style="background-color: #244960;">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add Fee Type</h5>
            <hr />
            <form action="{{ route('admin.fee-types.store') }}" method="POST">
                @csrf

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="border border-3 p-4 rounded">
                                <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960;">Add Fee Type</button>
                            </div>

                        </div>
                    </div><!--end row-->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
