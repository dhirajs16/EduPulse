@extends('frontend.dashboard.layouts.master')
@section('title', 'Dashboard')
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
								<li class="breadcrumb-item active" aria-current="page">User Profile</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" style="">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
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
                                        <h5>Parent Details</h5>
                                    </div>
									<div class="card-body">
                                        {{-- Father's Name --}}
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Father's Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{ $user->father_name }}" disabled>
											</div>
										</div>
                                        {{-- Mother's Name --}}
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Mothers's Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{ $user->mother_name }}" disabled>
											</div>
										</div>
                                        {{-- Guardian's Name --}}
										<div class="row mb-3">
											<div class="col-sm-3">
                                                <h6 class="mb-0">Local Guardian Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{ $user->guardian_name }}" disabled>
											</div>
										</div>
                                        {{-- Relation with Guardian --}}
										<div class="row mb-3">
											<div class="col-sm-3">
                                                <h6 class="mb-0">Relation</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{ $user->relationship_with_guardian }}" disabled>
											</div>
										</div>
                                        {{-- Guardian Contact --}}
										<div class="row mb-3">
											<div class="col-sm-3">
                                                <h6 class="mb-0">Contact Info</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{ $user->guardian_contact }}" disabled>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
