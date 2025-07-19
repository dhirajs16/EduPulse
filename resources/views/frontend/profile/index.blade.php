@extends('frontend.dashboard.layouts.master')
@section('content')
    <div class="dashboard-body__content">
        <!-- Profile Content Start -->
        <div class="profile">
            <div class="row gy-4">
                <div class="col-xxl-3 col-xl-4">
                    <div class="profile-info">
                        <div class="profile-info__inner mb-40 text-center">

                            <div class="avatar-upload mb-24">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg">
                                    <label for="imageUpload">
                                        <img src="assets/images/icons/camera.svg" alt="">
                                    </label>
                                </div>
                                <div class="avatar-preview" style="background-image: url({{ $user->avatar }})">
                                    <div id="imagePreview">
                                    </div>
                                </div>
                            </div>

                            <h5 class="profile-info__name mb-1">{{ $user->name }}</h5>
                            <span class="profile-info__designation font-14">{{ __('Customer') }}</span>
                        </div>

                        <ul class="profile-info-list">
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-user"></i>
                                    <span class="text text-heading fw-500">Name</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->name }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-mail-forward"></i>
                                    <span class="text text-heading fw-500">Email</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->email }}</span>
                            </li>
                            {{-- <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-phone-plus"></i>
                                    <span class="text text-heading fw-500">Phone</span>
                                </span>
                                <span class="profile-info-list__info">+880 15589 236 45</span>
                            </li> --}}
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-map-pin"></i>
                                    <span class="text text-heading fw-500">Country</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->country }}</span>
                            </li>
                            {{-- <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-currency-dollar"></i>
                                    <span class="text text-heading fw-500">Balance</span>
                                </span>
                                <span class="profile-info-list__info">$0.00 USD</span>
                            </li> --}}
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-calendar-month"></i>
                                    <span class="text text-heading fw-500">Member Since</span>
                                </span>
                                <span class="profile-info-list__info">Jan, 01, 2024</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-basket-check"></i>
                                    <span class="text text-heading fw-500">Purchased</span>
                                </span>
                                <span class="profile-info-list__info">0 items</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header pb-0">
                            <ul class="nav tab-bordered nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading active" id="pills-personalInfo-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-personalInfo" type="button"
                                        role="tab" aria-controls="pills-personalInfo" aria-selected="true">Personal
                                        Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading" id="pills-payouts-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-payouts" type="button" role="tab"
                                        aria-controls="pills-payouts" aria-selected="false">Payouts</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading" id="pills-changePassword-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-changePassword" type="button"
                                        role="tab" aria-controls="pills-changePassword" aria-selected="false">Change
                                        Password</button>
                                </li>
                            </ul>
                        </div>

                        <div class="profile-info-content">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-personalInfo" role="tabpanel"
                                    aria-labelledby="pills-personalInfo-tab" tabindex="0">
                                    {{-- Person Info Update form --}}
                                    @include('frontend.profile.personal-info')
                                </div>
                                <div class="tab-pane fade" id="pills-payouts" role="tabpanel"
                                    aria-labelledby="pills-payouts-tab" tabindex="0">
                                    {{-- Payouts form --}}
                                    @include('frontend.profile.payouts')
                                </div>
                                <div class="tab-pane fade" id="pills-changePassword" role="tabpanel"
                                    aria-labelledby="pills-changePassword-tab" tabindex="0">
                                    {{-- Update Password form --}}
                                    @include('frontend.profile.change-password')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Content End -->

    </div>
@endsection
