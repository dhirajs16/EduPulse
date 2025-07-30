@extends('admin.layouts.master')
@section('title', 'Students List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Students</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary radius-30" style="background-color: #244960;"><i class="bx bxs-plus-square"></i>Add New Student</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">
                <div class="col-md-3">
                    <input type="text" id="nameSearch" class="form-control" placeholder="Search by Name">
                </div>
                {{-- <div class="col-md-3">
                    <input type="text" id="fatherNameSearch" class="form-control" placeholder="Search by Father's Name">
                </div>
                <div class="col-md-3">
                    <input type="text" id="motherNameSearch" class="form-control" placeholder="Search by Mother's Name">
                </div> --}}
                <div class="col-md-3">
                    <input type="text" id="emailSearch" class="form-control" placeholder="Search by Email">
                </div>
                <div class="col-md-3">
                    <input type="text" id="guardianNameSearch" class="form-control" placeholder="Search by Guardian Name">
                </div>
                <div class="col-md-3">
                    <input type="text" id="gradeSearch" class="form-control" placeholder="Search by Grade">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30"  style="background-color:  #244960;">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div
                id="studentsData"
                data-items='{!! $students->map(function($student){
                    return [
                        "id" => $student->id,
                        "avatar" => $student->avatar ? asset("storage/".$student->avatar) : null,
                        "first_name" => $student->first_name,
                        "middle_name" => $student->middle_name,
                        "last_name" => $student->last_name,
                        "email" => $student->user->email,
                        "full_name" => trim($student->first_name." ".$student->middle_name." ".$student->last_name),
                        "father_name" => $student->father_name,
                        "mother_name" => $student->mother_name,
                        "guardian_name" => $student->guardian_name,
                        "grade" => $student->grade->name ?? '',
                        "date_of_birth" => $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : null,
                    ];
                })->toJson() !!}'
                style="display:none;">
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Grade</th>
                            <th>Guardian Name</th>
                            <th>Fee Status</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container (JS will inject) --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('students.script')
@endsection
