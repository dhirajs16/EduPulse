@extends('frontend.dashboard.layouts.master')
@section('title', 'Change Password')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false"> <span class="visually-hidden">Toggle
                            Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" style=""> <a
                            class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        @include('frontend.dashboard.profile.user_detail')
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Change Password') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="page-content">
                                    <form action="{{ route('profile.password.update') }}" autocomplete="off" method="POST">
                                        @csrf
                                        @method('PUT')
                                        {{-- current password --}}
                                        <div class="col-md-12 mb-3">
                                            <label for="current_password"
                                                class="form-label">{{ __('Current Password') }}</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current-password" placeholder="************">
                                            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                        </div>

                                        {{-- new password --}}
                                        <div class="col-md-12 mb-3">
                                            <label for="new_password" class="form-label">{{ __('New Password') }}</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control" placeholder="************">
                                            <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                                        </div>

                                        {{-- re-type new password --}}
                                        <div class="col-md-12 mb-3">
                                            <label for="new_password_confirmation"
                                                class="form-label">{{ __('Confirm Password') }}</label>
                                            <input type="password" class="form-control" name="new_password_confirmation"
                                                id="new_password_confirmation" placeholder="************">
                                            <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                                        </div>

                                        {{-- update buttton --}}
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary flex-fill radius-30"
                                                style="background-color:  #244960;"> Update
                                                Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
									<div class="col-sm-12">
										<div class="card">
											<div class="card-body">
												<h5 class="d-flex align-items-center mb-3">Project Status</h5>
												<p>Web Design</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Website Markup</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>One Page</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Mobile Template</p>
												<div class="progress mb-3" style="height: 5px">
													<div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<p>Backend API</p>
												<div class="progress" style="height: 5px">
													<div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</div>
								</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
