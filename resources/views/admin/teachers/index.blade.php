@extends('admin.layouts.master')
@section('title', 'Teachers List')
@section('content')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Teachers</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Teachers</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add New Teacher</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                {{-- Search inputs --}}
                <div class="row align-items-end mb-3 g-3">
                    <div class="col-md-3">
                        <input type="text" id="nameSearch" class="form-control" placeholder="Search by Name">
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="emailSearch" class="form-control" placeholder="Search by Email">
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="subjectSearch" class="form-control" placeholder="Search by Subject">
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="gradeSearch" class="form-control" placeholder="Search by Class (Grade)">
                    </div>

                    <div class="col-md-2">
                        <select id="genderSearch" class="form-select">
                            <option value="">All Genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select id="statusSearch" class="form-select">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                        <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                    </div>
                </div>

                @php
                    $teachersJsonData = $teachers->map(function ($teacher) {
                        return [
                            'id' => $teacher->id,
                            'name' => $teacher->name,
                            'email' => $teacher->user->email,
                            'subjects' => $teacher->subjects->pluck('name')->toArray(),
                            'grades' => $teacher->grades->pluck('name')->toArray(),
                            'gender' => $teacher->gender,
                            'salary' => number_format($teacher->salary ?? 0, 2),
                            // 'status' => $teacher->status,
                        ];
                    });
                @endphp
                {{-- Hidden JSON data --}}
                <div id="teachersData" data-items='@json($teachersJsonData)' style="display:none;"></div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subjects</th>
                                <th>Classes</th>
                                <th>Gender</th>
                                <th>Salary</th>
                                {{-- <th>Status</th> --}}
                                <th style="width: 110px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Rendered by JS --}}
                        </tbody>
                    </table>
                </div>

                {{-- Pagination container injected by JS --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.teachers.script')
@endsection
