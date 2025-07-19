
@extends('frontend.layouts.master')
@section('content')

    <section class="wsus__login padding-y-120 d-flex justify-content-center align-items-center" style="height: 100svh;">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="wsus__login_area">
                        <h2>{{ __('Welcome!') }}</h2>
                        <p>{{ __('Register to continue') }}</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('Name') }}</label>
                                        <input class="form-control" type="text" placeholder="Name" id="name" name="name"
                                            :value="{{ old('name') }}" required autofocus autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('email') }}</label>
                                        <input class="form-control" type="email" placeholder="Email" id="email" name="email"
                                            :value="{{ old('email') }}" required autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('password') }}</label>
                                        <input class="form-control" type="password" placeholder="Password" id="password" name="password"
                                            required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <label class="form-label">{{ __('Confirm password') }}</label>
                                        <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation"
                                            id="password_confirmation" required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_input">
                                        <button type="submit" class=" border py-2 px-5 wow fadeInUp btn btn-primary mt-2">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="create_account mt-2">{{ __('Have an account ?') }} <a style="color: #f4a02a"
                                href="{{ route('login') }}">{{ __('Log In') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- ======================== Register Section End ===================== -->
