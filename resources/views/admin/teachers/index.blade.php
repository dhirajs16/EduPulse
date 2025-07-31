@extends('admin.layouts.master')
@section('title', 'Teachers List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Teachers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Teachers</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add New Teacher</a>
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

                <div class="col-md-3">
                    <input type="text" id="emailSearch" class="form-control" placeholder="Search by User Email">
                </div>

                <div class="col-md-2">
                    <select id="genderSearch" class="form-select">
                        <option value="">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>

            </div>

            {{-- Hidden JSON data container --}}
            <div id="teachersData" data-items='{!! $teachers->map(function($teacher){
                $subjectNames = $teacher->subjects->pluck("name")->toArray();
                $gradeNames = $teacher->grades->pluck("name")->toArray();
                return [
                    "id" => $teacher->id,
                    "avatar" => $teacher->avatar ? asset("storage/".$teacher->avatar) : null,
                    "full_name" => trim($teacher->prefix." ".$teacher->first_name." ".$teacher->middle_name." ".$teacher->last_name),
                    "gender" => $teacher->gender,
                    "user_email" => strtolower($teacher->user->email ?? ""),
                    "contact" => $teacher->contact ?? "",
                    "subjects" => $subjectNames,
                    "grades" => $gradeNames
                ];
            })->toJson() !!}'
            style="display:none;"></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>User Email</th>
                            <th>Contact</th>
                            <th>Subjects</th>
                            <th>Grades</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container inserted dynamically --}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.teachers.script')
@endsection
