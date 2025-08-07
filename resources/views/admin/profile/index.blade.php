@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </nav>
            </div>

        </div>
        {{-- Edit Profile section --}}
        <div class="card">
            <div class="card-body p-3">
                <div class="card-header">

                    <h5 class="card-title">{{ __('Edit Profile') }}</h5>
                </div>

                {{-- avatar preview --}}
                <img class="my-3 rounded-circle" src="{{ Auth::user()->avatar }}" alt="avatar" width="100px">

                {{-- Admin Profile Update Form --}}
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-cards">


                        {{-- avatar field --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="avatar"
                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Avatar') }}</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                            </div>
                        </div>

                        {{-- name field --}}
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name"
                                    value="{{ Auth::user()->name }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        {{-- email field --}}
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input id="email" name="email" type="email"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email"
                                    value="{{ Auth::user()->email }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        {{-- submit button --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="btn radius-30 btn-primary" style="background-color: #244960" type="submit" value="{{ __('Update Profile') }}">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>


        {{-- Change Password Section --}}
        <div class="card">
            <div class="card-body p-3">
                <div class="card-header">

                    <h5 class="card-title">{{ __('Change Password') }}</h5>
                </div>

                {{-- Password Change Form --}}
                <form action="{{ route('admin.profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row row-cards">


                        {{-- Current Password field --}}
                        <div class="col-md-12">
                            <div class="my-3">
                                <label for="current_password"
                                    class="form-label mb-2 font-heading fw-600">{{ __('Current Password') }}</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                    id="current_password" name="current_password" placeholder="Current Password">
                                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                            </div>
                        </div>

                        {{-- new password field --}}
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">{{ __('New Password') }}</label>
                                <input id="new_password" name="new_password" type="password"
                                    class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                    placeholder="New Password">
                                <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                            </div>
                        </div>

                        {{-- confirm password field --}}
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                                    class="form-control" placeholder="Confirm Password">
                                <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                        {{-- submit button --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="btn btn-primary radius-30" style="background-color: #244960" type="submit" value="{{ __('Change Password') }}">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>



    @include('admin.layouts.footer')
    </div>
@endsection
