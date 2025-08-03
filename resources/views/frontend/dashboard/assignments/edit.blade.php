@extends('frontend.dashboard.layouts.master')
@section('title', 'Edit Assignment')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Assignments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Assignment</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('assignments.index', $teacher->id) }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Assignment</h5>
            <hr />
            <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="number" name="teacher_id" value="{{ $teacher->id }}" hidden>

                {{-- Grade dropdown limited to allowed teacher grades --}}
                <div class="mb-3">
                    <label for="grade_id" class="form-label">Grade <span class="text-danger">*</span></label>
                    <select name="grade_id" id="grade_id" class="form-select @error('grade_id') is-invalid @enderror" required>
                        <option value="">Select Grade</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $assignment->grade_id) == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Subject dropdown --}}
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject (Optional)</label>
                    <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $assignment->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $assignment->title) }}" required>
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $assignment->description) }}</textarea>
                    @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', optional($assignment->due_date)->format('Y-m-d')) }}">
                    @error('due_date')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="1" {{ old('status', $assignment->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $assignment->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                {{-- Note: The teacher_id is set internally, generally not editable --}}

                <button type="submit" class="btn btn-primary">Update Assignment</button>
            </form>
        </div>
    </div>
</div>

@endsection
