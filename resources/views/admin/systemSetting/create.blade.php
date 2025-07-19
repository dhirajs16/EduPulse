{{-- @extends('backend.layout.main')

@section('title')
    System Settings
@endsection

@section('content')
    <div>
        <h2 style="text-align: center;">{{ isset($systemSetting) ? 'Edit' : 'Create' }} System Setting</h2>


        <div>
            <div>
                <form method="POST"
                    action="{{ isset($systemSetting) ? route('system-settings.update', $systemSetting->id) : route('system-settings.store') }}">
                    @csrf
                    @if (isset($systemSetting))
                        @method('PUT')
                    @endif

                    {{-- key field
                    <div>
                        <label for="key">
                            Key
                        </label>
                        <input type="text" name="key" placeholder="Key"
                            value="{{ old('key', $systemSetting->key ?? '') }}">
                        @error('key')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- value field
                    <div>
                        <label for="value">
                            Value
                        </label>
                        <input type="text" name="value" placeholder="Value"
                            value="{{ old('value', $systemSetting->value ?? '') }}">
                        @error('value')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description field
                    <div>
                        <label for="description">
                            Description
                        </label>
                        <input type="text" name="description" placeholder="Description"
                            value="{{ old('description', $systemSetting->description ?? '') }}">
                        @error('description')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- status field
                    <div>
                        <label for="status">
                            Status
                        </label>
                        <select name="status" id="status">
                            <option value="0"
                                {{ old('status', $systemSetting->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                            <option value="1"
                                {{ old('status', $systemSetting->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="2"
                                {{ old('status', $systemSetting->status ?? '') == '2' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('status')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- code field
                    <div>
                        <label for="code">
                            Code
                        </label>
                        <input type="number" name="code" placeholder="Code"
                            value="{{ old('code', $systemSetting->code ?? '') }}">
                        @error('code')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit">{{ isset($systemSetting) ? 'Update' : 'Create' }}</button>
                </form>

                <div class="ms-auto">
                    <a class="btn btn-primary radius-30 mt-2 mt-lg-0" href="{{ route('system-settings.index') }}">Back to System Setting List</a>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('admin.layouts.master')
@section('title', 'Pages')
@section('content')
    <div class="page-content">
        <!--breadcrumb starts-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('System Settings') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if (isset($systemSetting))
                                Edit
                            @else
                                Create
                            @endif
                            System Setting
                        </li>
                    </ol>
                </nav>
            </div>
            {{-- setting dropdown starts --}}
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
            {{-- setting dropdown ends --}}
        </div>
        <!--end breadcrumb-->

        {{-- card content starts --}}
        <div class="card">
            <div class="card-body p-4">
                <div class="d-lg-flex">

                    <h5 class="card-title">
                        @if (isset($systemSetting))
                            Edit
                        @else
                            Create
                        @endif
                        System Setting
                    </h5>
                    <div class="ms-auto">
                        <a class="btn btn-primary radius-30 mt-2 mt-lg-0" href="{{ route('admin.system-settings.index') }}">
                            <i class="bx bx-arrow-back"></i>Back to System Setting List</a>
                    </div>
                </div>
                <hr />
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="border border-3 p-4 rounded">
                                <form method="POST"
                                    action="{{ isset($systemSetting) ? route('admin.system-settings.update', $systemSetting->id) : route('admin.system-settings.store') }}">
                                    @csrf
                                    @if (isset($systemSetting))
                                        @method('PUT')
                                    @endif

                                    {{-- key field --}}
                                    <div class="mb-3">
                                        <label for="key" class="form-label">
                                            Key
                                        </label>
                                        <input type="text" class="form-control" name="key" placeholder="Enter Key"
                                            value="{{ old('key', $systemSetting->key ?? '') }}">
                                        @error('key')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- value field --}}
                                    <div class="mb-3">
                                        <label for="value" class="form-label">
                                            Value
                                        </label>
                                        <input type="text" class="form-control" name="value" placeholder="Enter Value"
                                            value="{{ old('value', $systemSetting->value ?? '') }}">
                                        @error('value')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- description field --}}
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            Description
                                        </label>
                                        <input type="text" class="form-control w-100" name="description" placeholder="Enter Description"
                                            value="{{ old('description', $systemSetting->description ?? '') }}" rows="3">
                                        @error('description')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- status field --}}

                                    <div class="mb-3">
                                        <label for="status">
                                            Status
                                        </label>
                                        <select class="form-select" aria-label="Default select example" name="status" id="status">
                                            <option value="0"
                                                {{ old('status', $systemSetting->status ?? '') == '0' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option value="1"
                                                {{ old('status', $systemSetting->status ?? '') == '1' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="2"
                                                {{ old('status', $systemSetting->status ?? '') == '2' ? 'selected' : '' }}>
                                                Pending</option>
                                        </select>
                                        @error('status')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- code field --}}
                                    <div class="mb-3">
                                        <label for="code" class="form-label">
                                            Code
                                        </label>
                                        <input type="number" name="code" placeholder="Code" class="form-control"
                                            value="{{ old('code', $systemSetting->code ?? '') }}">
                                        @error('code')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <button class="btn btn-primary radius-10 mt-2 mt-lg-0"
                                        type="submit">{{ isset($systemSetting) ? 'Update' : 'Create' }}</button>
                                </form>

                            </div>
                        </div>

                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection
