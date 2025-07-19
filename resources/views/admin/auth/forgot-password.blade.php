{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <h1 class="text-white">Admin Forget Password!</h1>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ __('Admin Login') }}</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column bg-[#f5f5f5]">
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="./static/logo.svg" width="110" height="32" alt="EduPulse"
                        class="navbar-brand-image">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{ __('Forget Admin Password') }}</h2>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{-- login form --}}
                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf
                        {{-- email field --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email address') }}</label>
                            <input type="email" class="form-control" placeholder="your@email.com" name="email"
                                :value="{{ old('email') }}" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        {{-- login button --}}
                        <div class="form-footer">
                            <button type="submit"
                                class="btn btn-dark w-100">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>
</body>

</html>
