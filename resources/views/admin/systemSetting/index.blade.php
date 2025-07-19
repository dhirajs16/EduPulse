@extends('admin.layouts.master')
@section('title', 'System Settings')
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('All System Settings') }}</li>
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

        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        {{-- search form starts --}}
                        <form class="d-lg-flex gap-1">

                            <input type="text" class="form-control ps-5 radius-30" name="keySearch" id="keySearch"
                                placeholder="Search by key">

                            <input type="text" class="form-control ps-5 radius-30" name="valueSearch" id="valueSearch"
                                placeholder="Search by value">


                            <button class="btn btn-primary radius-30 mt-2 mt-lg-0" id="search-button" type="submit">Search</button>
                            <button class="btn btn-primary radius-30 mt-2 mt-lg-0" id="reset-button" type="submit">Reset</button>


                            <input type="hidden" id="hidden_page" value="1">
                        </form>

                        {{-- search form ends --}}

                    </div>
                    <div class="ms-auto"><a href="{{ route('admin.system-settings.create') }}"
                            class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New
                            System Settings</a></div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.systemSetting.partials.table')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
