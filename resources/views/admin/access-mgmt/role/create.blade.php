@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('Roles') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Roles') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-primary radius-30"
                    style="background-color: #244960;">Back to List</a>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="card">
            <div class="card-body p-4">
                <h4 class="card-title">{{ __('Create Roles') }}</h4>
                <hr>


                <form id="roleForm" action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf

                    {{-- role field --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">{{ __('Role') }}</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Role">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    </div>
                    <hr>
                    <div class="row">
                        @foreach ($permissions as $groupName => $permissionItems)
                            <div class="col-md-4">
                                <h4>{{ $groupName }}</h4>
                                @foreach ($permissionItems as $permission)
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                            name="permissions[]">
                                        <span class="form-check-label">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </form>
            </div>


            <div class="card-footer">
                <div class="card-actions">
                    {{-- submit button --}}
                    <button class="btn btn-primary radius-30" style="background-color: #244960;"
                        onclick="$('#roleForm').submit()" type="submit">{{ __('Create') }}</button>
                </div>
            </div>
        </div>



        @include('admin.layouts.footer')
    </div>
@endsection
