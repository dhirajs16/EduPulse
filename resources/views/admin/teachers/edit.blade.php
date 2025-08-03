@extends('admin.layouts.master')
@section('title', 'Edit Teacher')
@section('content')
<div class="page-content">

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
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Teacher</h5>
            <hr />
            <form method="POST" action="{{ route('admin.teachers.update', $teacher->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                                @if($teacher->avatar)
                                    <img src="{{ asset('storage/'.$teacher->avatar) }}" alt="avatar" height="80" class="mt-2 rounded" />
                                @endif
                                @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="prefix" class="form-label">Prefix <span class="text-danger">*</span></label>
                                <input type="text" name="prefix" id="prefix" class="form-control @error('prefix') is-invalid @enderror" value="{{ old('prefix', $teacher->prefix) }}" required>
                                @error('prefix') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $teacher->first_name) }}" required>
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name', $teacher->middle_name) }}">
                                @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $teacher->last_name) }}" required>
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $teacher->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $teacher->date_of_birth ? \Carbon\Carbon::parse($teacher->date_of_birth)->format('Y-m-d') : '') }}">
                                @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nid" class="form-label">NID</label>
                                <input type="text" name="nid" id="nid" class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $teacher->nid) }}">
                                @error('nid') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- other fields omitted for brevity: contact, personal_email, address, city, country, postal_code -->

                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $teacher->salary) }}">
                                @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Joining date, qualification, user_id fields -->

                            {{-- Grade - Subject pairs --}}
                            <div class="mb-3">
                                <label class="form-label">Assign Subjects to Grades</label>
                                <small class="form-text text-muted">Select grade and subject pairs this teacher teaches.</small>
                                <div id="grade-subject-pairs">
                                    @php
                                        $oldPairs = old('grade_subjects', collect($gradeSubjects)->toArray());
                                    @endphp
                                    @foreach($oldPairs as $index => $pair)
                                    <div class="row mb-2 grade-subject-row">
                                        <div class="col">
                                            <select name="grade_subjects[{{ $index }}][grade_id]" class="form-select" required>
                                                <option value="">Select Grade</option>
                                                @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" {{ ($pair['grade_id'] ?? '') == $grade->id ? 'selected' : '' }}>
                                                    {{ $grade->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="grade_subjects[{{ $index }}][subject_id]" class="form-select" required>
                                                <option value="">Select Subject</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}" {{ ($pair['subject_id'] ?? '') == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="addPair" class="btn btn-sm btn-secondary">Add Grade-Subject Pair</button>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="1" {{ old('status', $teacher->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $teacher->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> --}}

                            <div class="border border-3 p-4 rounded">
                                <button type="submit" class="btn btn-primary">Update Teacher</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    let pairIndex = {{ count(old('grade_subjects', (array) $gradeSubjects)) }};
    const addBtn = document.getElementById('addPair');
    const container = document.getElementById('grade-subject-pairs');

    addBtn.addEventListener('click', () => {
        const row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'grade-subject-row');
        row.innerHTML = `
            <div class="col">
                <select name="grade_subjects[${pairIndex}][grade_id]" class="form-select" required>
                    <option value="">Select Grade</option>
                    @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="grade_subjects[${pairIndex}][subject_id]" class="form-select" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
        `;
        container.appendChild(row);
        pairIndex++;
    });

    container.addEventListener('click', e => {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.grade-subject-row').remove();
        }
    });
});
</script>
@endsection
