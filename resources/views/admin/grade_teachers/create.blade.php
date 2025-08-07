@extends('admin.layouts.master')
@section('title', 'Add Grade Teacher Assignment')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Grade Teachers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Assignment</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.grade_teachers.index') }}" class="btn btn-primary radius-30" style="background-color: #244960">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Add Grade Teacher Assignment</h5>
            <hr />
            <form action="{{ route('admin.grade_teachers.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-4 mb-3">
                        <label for="grade_id" class="form-label">Grade <span class="text-danger">*</span></label>
                        <select name="grade_id" id="grade_id" class="form-select @error('grade_id') is-invalid @enderror" required>
                            <option value="">Select Grade</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                            @endforeach
                        </select>
                        @error('grade_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-lg-4 mb-3">
                        <label for="teacher_id" class="form-label">Teacher <span class="text-danger">*</span></label>
                        <select name="teacher_id" id="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-lg-4 mb-3">
                        <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                        <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                            <option value="">Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="border border-3 p-4 rounded mt-3">
                    <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960">Add Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
