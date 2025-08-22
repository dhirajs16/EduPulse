@extends('frontend.layouts.master')
@section('content')
    <section class="wsus__login padding-y-120 d-flex justify-content-center align-items-center" style="height: 100svh;">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="wsus__login_area">
                        <h2>{{ __('Welcome!') }}</h2>
                        <p>{{ __('Request for free demo') }}</p>
                        <form method="POST" action="{{ route('request_demo.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('School Name') }}</label>
                                        <input class="form-control" type="text" placeholder="Name" id="school_name"
                                            name="school_name" :value="{{ old('name') }}" required autofocus
                                            autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12  mb-3">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input class="form-control" type="email" placeholder="Email" id="email"
                                            name="email" :value="{{ old('email') }}" required autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <input type="text" name="country_code" value="+977" hidden>
                                <div class="col-xl-12 mb-3">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('Contact No.') }}</label>
                                        <input class="form-control" type="text" placeholder="Contact No." id="phone"
                                            name="phone" :value="{{ old('phone') }}" required autocomplete="username">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('Message') }}</label>
                                        <textarea class="form-control" placeholder="Message" id="message" name="message" rows="4" required
                                            autocomplete="username">{{ old('message') }}</textarea>
                                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    </div>
                                </div>

                                <input type="text" name="status" value="pending" hidden>


                                <div class="col-xl-12 mb-3">
                                    <div class="wsus__login_input">
                                        <button type="submit"
                                            class=" border py-2 px-5 wow fadeInUp btn btn-primary mt-2">{{ __('Request For Demo') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- ======================== Register Section End ===================== -->
