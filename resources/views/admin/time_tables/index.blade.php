@extends('admin.layouts.master')
@section('title', 'Timetable List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Timetable</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Timetable</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.time-tables.create') }}" class="btn btn-primary">Add Timetable Entry</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">

                <div class="col-md-2">
                    <select id="daySearch" class="form-select">
                        <option value="">Filter by Day</option>
                        @foreach(['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
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

                <div class="col-md-3">
                    <select id="subjectSearch" class="form-select">
                        <option value="">Filter by Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ strtolower($subject->name) }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="teacherSearch" class="form-select">
                        <option value="">Filter by Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ strtolower(trim($teacher->prefix.' '.$teacher->first_name.' '.$teacher->last_name)) }}">
                                {{ trim($teacher->prefix.' '.$teacher->first_name.' '.$teacher->last_name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>

            </div>

            {{-- Hidden JSON data --}}
            <div
                id="timeTablesData"
                data-items='{!! $timeTables->map(function($tt) {
                    $teacherName = trim($tt->teacher->prefix.' '.$tt->teacher->first_name.' '.$tt->teacher->last_name);
                    return [
                        "id" => $tt->id,
                        "day" => $tt->day,
                        "start_time" => $tt->start_time,
                        "end_time" => $tt->end_time,
                        "grade" => strtolower($tt->grade->name ?? ''),
                        "grade_name" => $tt->grade->name ?? '',
                        "subject" => strtolower($tt->subject->name ?? ''),
                        "subject_name" => $tt->subject->name ?? '',
                        "teacher" => strtolower($teacherName),
                        "teacher_name" => $teacherName,
                    ];
                })->toJson() !!}'
                style="display:none;"></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Grade</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- JS will insert rows --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container appended by JS --}}

        </div>
    </div>
</div>
@endsection

@section('script')
@include('admin.time_tables.script')
@endsection
