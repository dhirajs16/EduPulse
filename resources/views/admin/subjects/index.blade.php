@extends('admin.layouts.master')
@section('title', 'Subjects List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Subjects</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Subjects</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary radius-30" style="background-color: #244960;">Add New Subject</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">
                <div class="col-md-3">
                    <input type="text" id="codeSearch" class="form-control" placeholder="Search by Code">
                </div>
                <div class="col-md-3">
                    <input type="text" id="nameSearch" class="form-control" placeholder="Search by Name">
                </div>
                <div class="col-md-3">
                    <select id="typeSearch" class="form-select">
                        <option value="">All Types</option>
                        <option value="core">Core</option>
                        <option value="elective">Elective</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="statusSearch" class="form-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30" style="background-color: #244960;">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div
                id="subjectsData"
                data-items='{!! $subjects->map(function($subject){
                    return [
                        "id" => $subject->id,
                        "code" => strtolower($subject->code),
                        "name" => strtolower($subject->name),
                        "description" => $subject->description,
                        "type" => $subject->type,
                        "credit_hours" => $subject->credit_hours,
                        "status" => $subject->status,
                    ];
                })->toJson() !!}'
                style="display:none;">
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Credit Hours</th>
                            <th>Status</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container (inserted by JS) --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.subjects.script')
@endsection
