@extends('admin.layouts.master')
@section('content')
    <div class="p-2">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Create Users') }}</h3>
                                <div class="card-actions">
                                    <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary flex gap-2">
                                        <i class="bi bi-arrow-left"></i>
                                        {{ __(' Back to All Users') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="roleUserForm" action="{{ route('admin.role-users.store') }}" method="POST">
                                    @csrf

                                    <div class="row">

                                        {{-- name field --}}
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">{{ __('Name') }}</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        </div>

                                        {{-- email field --}}
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">{{ __('Email') }}</label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                placeholder="email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        </div>

                                        {{-- password field --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ __('Password') }}</label>
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
                                                <div class="form-label">{{ __('Select Role') }}</div>
                                                <select class="form-select" name="role">
                                                    <option value="">Select</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
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
                                    <button class="btn btn-primary" onclick="$('#roleUserForm').submit()"
                                        type="submit">{{ __('Create') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
@endsection
