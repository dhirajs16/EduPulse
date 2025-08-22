@extends('admin.layouts.master')
@section('title', 'View Syllabus')
@section('content')
<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Syllabi</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.syllabi.index') }}">Syllabi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Syllabus</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.syllabi.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">

            <h5 class="mb-4">Syllabus Details</h5>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Grade</th>
                        <td>{{ $syllabus->grade->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Subject</th>
                        <td>{{ $syllabus->subject->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Chapter Number</th>
                        <td>{{ $syllabus->chapter_number }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Title</th>
                        <td>{{ $syllabus->title }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Sub Topics</th>
                        <td>{!! nl2br(e($syllabus->sub_topics)) !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Credit Hours</th>
                        <td>{{ $syllabus->credit_hours }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Created At</th>
                        <td>{{ $syllabus->created_at->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Updated At</th>
                        <td>{{ $syllabus->updated_at->format('Y-m-d') }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
