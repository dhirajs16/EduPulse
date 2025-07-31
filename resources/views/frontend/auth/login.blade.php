@extends('frontend.layouts.master')
@section('content')
    <section class="wsus__login padding-y-120 d-flex justify-content-center align-items-center" style="height: 100svh">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="wsus__login_area">
                        <h2>Welcome back!</h2>
                        <p>sign in to continue</p>

                        {{-- Login Form --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">Email</label>
                                        <input type="email" placeholder="Enter Email" name="email" class="form-control"
                                            :value="{{ old('email') }}" required autofocus autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">Password</label>
                                        <input type="password" placeholder="Password" name="password" required class="form-control"
                                            autocomplete="current-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input wsus__login_check_area">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ __('Remeber Me') }}
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a style="color: #f4a02a" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <button class=" border py-2 px-5 wow fadeInUp btn btn-primary" type="submit" class="">{{ __('Log In') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <p class="create_account" >{{ __("Don't have an account ? ") }}<a style="color: #f4a02a" href="{{ route('register') }}">{{ __('Register') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
