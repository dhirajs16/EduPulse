@extends('admin.layouts.master')
@section('title', 'Edit Student')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Students</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.students.index') }}" class="btn btn-primary radius-30" style="background-color: #244960">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Student</h5>
            <hr />

            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="border border-3 p-4 rounded">

                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    @if ($student->avatar)
                                    <div class="mb-1">
                                        <img src="{{ asset('storage/' . $student->avatar) }}" alt="avatar" width="80" height="80" class="rounded-circle" />
                                    </div>
                                    @endif
                                    <input
                                        type="file"
                                        name="avatar"
                                        id="avatar"
                                        class="form-control @error('avatar') is-invalid @enderror"
                                    >
                                    @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Repeated fields with old or model data -->
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name', $student->first_name) }}"
                                        required
                                    >
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input
                                        type="text"
                                        name="middle_name"
                                        id="middle_name"
                                        class="form-control @error('middle_name') is-invalid @enderror"
                                        value="{{ old('middle_name', $student->middle_name) }}"
                                    >
                                    @error('middle_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $student->last_name) }}"
                                        required
                                    >
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input
                                        type="date"
                                        name="date_of_birth"
                                        id="date_of_birth"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        value="{{ old('date_of_birth', $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : '') }}"
                                    >
                                    @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Repeat for address, city, country, postal code -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $student->address) }}"
                                    >
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input
                                        type="text"
                                        name="city"
                                        id="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city', $student->city) }}"
                                    >
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input
                                        type="text"
                                        name="country"
                                        id="country"
                                        class="form-control @error('country') is-invalid @enderror"
                                        value="{{ old('country', $student->country) }}"
                                    >
                                    @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input
                                        type="text"
                                        name="postal_code"
                                        id="postal_code"
                                        class="form-control @error('postal_code') is-invalid @enderror"
                                        value="{{ old('postal_code', $student->postal_code) }}"
                                    >
                                    @error('postal_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="father_name" class="form-label">Father Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="father_name"
                                        id="father_name"
                                        class="form-control @error('father_name') is-invalid @enderror"
                                        value="{{ old('father_name', $student->father_name) }}"
                                        required
                                    >
                                    @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mother_name" class="form-label">Mother Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="mother_name"
                                        id="mother_name"
                                        class="form-control @error('mother_name') is-invalid @enderror"
                                        value="{{ old('mother_name', $student->mother_name) }}"
                                        required
                                    >
                                    @error('mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="guardian_name" class="form-label">Guardian Name</label>
                                    <input
                                        type="text"
                                        name="guardian_name"
                                        id="guardian_name"
                                        class="form-control @error('guardian_name') is-invalid @enderror"
                                        value="{{ old('guardian_name', $student->guardian_name) }}"
                                    >
                                    @error('guardian_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="guardian_contact" class="form-label">Guardian Contact</label>
                                    <input
                                        type="text"
                                        name="guardian_contact"
                                        id="guardian_contact"
                                        class="form-control @error('guardian_contact') is-invalid @enderror"
                                        value="{{ old('guardian_contact', $student->guardian_contact) }}"
                                    >
                                    @error('guardian_contact')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="relationship_with_guardian" class="form-label">Relationship with Guardian</label>
                                    <input
                                        type="text"
                                        name="relationship_with_guardian"
                                        id="relationship_with_guardian"
                                        class="form-control @error('relationship_with_guardian') is-invalid @enderror"
                                        value="{{ old('relationship_with_guardian', $student->relationship_with_guardian) }}"
                                    >
                                    @error('relationship_with_guardian')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                    <select
                                        name="user_id"
                                        id="user_id"
                                        class="form-select @error('user_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $student->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="grade_id" class="form-label">Grade <span class="text-danger">*</span></label>
                                    <select
                                        name="grade_id"
                                        id="grade_id"
                                        class="form-select @error('grade_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">Select Grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ old('grade_id', $student->grade_id) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary radius-30" style="background-color: #244960">Update Student</button>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
