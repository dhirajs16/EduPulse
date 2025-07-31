@extends('admin.layouts.master')
@section('title', 'Fee Types List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fee Types</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fee Types</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.fee-types.create') }}" class="btn btn-primary radius-30" style="background-color: #244960;"><i class="bx bxs-plus-square"></i>Add New Fee Type</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search input --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="nameSearch" class="form-control" placeholder="Search by Name">
                </div>
                <div class="col-md-4">
                    <input type="text" id="descriptionSearch" class="form-control" placeholder="Search by Description">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30" style="background-color: #244960;">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div
                id="feeTypesData"
                data-items='{!! $feeTypes->map(function($feeType) {
                    return [
                        "id" => $feeType->id,
                        "name" => $feeType->name,
                        "description" => $feeType->description,
                        "created_at" => $feeType->created_at ? $feeType->created_at->format('Y-m-d') : null,
                    ];
                })->toJson() !!}'
                style="display:none;"
            ></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- JS will render rows here --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container injected by JS --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.fee_types.script')
@endsection
