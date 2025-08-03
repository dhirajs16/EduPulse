@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('Role Users') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Role Users') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary radius-30"
                    style="background-color: #244960;"><i class="bx bxs-plus-square"></i>{{ __('Back to List') }}</a>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h4 class="card-title">{{ __('Edit User') }}</h4>
                <hr>


                <form id="updateRoleUserForm" action="{{ route('admin.role-users.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- name field --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="name"
                                value="{{ $admin->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        </div>

                        {{-- email field --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="email"
                                value="{{ $admin->email }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                        {{-- password field --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('Change Password') }}</label>
                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        </div>

                        {{-- password-confirmation field --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirmation" name="password_confirmation" type="password"
                                class="form-control" placeholder="Re-type the password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        </div>
                        <hr>
                        <div class="row">

                            {{-- Select field for role --}}
                            <div class="mb-3">
                                <div class="form-label">{{ __('Role') }}</div>
                                <select class="form-select" name="role"
                                    @if ($admin->name == 'Super Admin') disabled @endif>
                                    <option value="">Select</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" @selected(in_array($role->name, $admin->getRoleNames()->toArray()))>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <div class="card-actions text-end">
                    {{-- submit button --}}
                    <button class="btn btn-primary radius-30" style="background-color: #244960;"
                        onclick="$('#updateRoleUserForm').submit()" type="submit">{{ __('Edit') }}</button>
                </div>
            </div>
        </div>

    @include('admin.layouts.footer')
    </div>
@endsection
