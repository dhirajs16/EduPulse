@extends('admin.layouts.master')
@section('title', 'Add Syllabus')
@section('content')
<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Syllabi</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Syllabus</li>
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

            <h5 class="card-title mb-4">Add New Syllabus</h5>

            <form method="POST" action="{{ route('admin.syllabi.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="grade_id" class="form-label">Grade <span class="text-danger">*</span></label>
                    <select id="grade_id" name="grade_id" class="form-select @error('grade_id') is-invalid @enderror" required>
                        <option value="">Select Grade</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                    <select id="subject_id" name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="chapter_number" class="form-label">Chapter Number <span class="text-danger">*</span></label>
                    <input type="number" id="chapter_number" name="chapter_number" min="1" class="form-control @error('chapter_number') is-invalid @enderror" value="{{ old('chapter_number') }}" required>
                    @error('chapter_number')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="sub_topics" class="form-label">Sub Topics <span class="text-danger">*</span></label>
                    <textarea id="sub_topics" name="sub_topics" rows="4" class="form-control @error('sub_topics') is-invalid @enderror" required>{{ old('sub_topics') }}</textarea>
                    @error('sub_topics')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label for="credit_hours" class="form-label">Credit Hours <span class="text-danger">*</span></label>
                    <input id="credit_hours" name="credit_hours" type="number" min="1" class="form-control @error('credit_hours') is-invalid @enderror" value="{{ old('credit_hours') }}" required>
                    @error('credit_hours')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Syllabus</button>
            </form>

        </div>
    </div>
</div>
@endsection
