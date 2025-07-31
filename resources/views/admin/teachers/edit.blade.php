@extends('admin.layouts.master')
@section('title', 'Edit Teacher')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Teachers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Teacher</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-primary radius-30" style="background-color: #244960;">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Teacher</h5>
            <hr />
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-body mt-4">
                    <div class="row">

                        <div class="col-lg-4 mb-3">
                            <label for="user_id" class="form-label">User Email <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                <option value="">Select User Email</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $teacher->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            @if ($teacher->avatar)
                                <div class="mb-1">
                                    <img src="{{ asset('storage/'.$teacher->avatar) }}" alt="avatar" width="80" height="80" class="rounded-circle" />
                                </div>
                            @endif
                            <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label for="prefix" class="form-label">Prefix <span class="text-danger">*</span></label>
                            <input type="text" name="prefix" id="prefix" class="form-control @error('prefix') is-invalid @enderror" value="{{ old('prefix', $teacher->prefix) }}" required>
                            @error('prefix')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Other existing fields each with old fallback -->
                        

                        <div class="col-lg-6 mb-3">
                            <label for="subjects" class="form-label">Subjects to Teach</label>
                            <select name="subject_ids[]" id="subjects" class="form-select @error('subject_ids') is-invalid @enderror" multiple>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ in_array($subject->id, old('subject_ids', $teacher->subjects->pluck('id')->toArray() )) ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_ids')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="grades" class="form-label">Grades / Classes to Teach</label>
                            <select name="grade_ids[]" id="grades" class="form-select @error('grade_ids') is-invalid @enderror" multiple>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}"
                                        {{ in_array($grade->id, old('grade_ids', $teacher->grades->pluck('id')->toArray() )) ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grade_ids')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="border border-3 p-4 rounded">
                        <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960;">Update Teacher</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
