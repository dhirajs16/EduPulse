<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ __('EduPulse') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        {{-- home --}}
        <a href="{{ route('home') }}">
            <div class="parent-icon"><i class='bx bx-home-alt'></i>
            </div>
            <div class="menu-title">Home</div>
        </a>

        {{-- dashboard --}}
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">{{ __('Dashboard') }}</div>
            </a>
        </li>

        {{-- profile dropdown --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                </div>
                <div class="menu-title">{{ __('Profile') }}</div>
            </a>
            <ul>
                <li> <a href="{{ route('profile.personal_info') }}">{{ __('Personal Info') }}</a>
                </li>
                <li> <a href="{{ route('profile.password') }}">{{ __('Change Password') }}</a>
                </li>
            </ul>
        </li>

        {{-- student exclusive nav-links --}}
        @if (Auth::guard('web')->user()->user_type == 'student')
            {{-- Time table --}}
            <li>
                <a href="{{ route('time-tables.show', Auth::guard('web')->user()->student->grade->id) }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Time Table</div>
                </a>
            </li>
            {{-- show assignments --}}
            <li>
                <a href="{{ route('assignments.show', Auth::guard('web')->user()->student->grade->id) }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Assignments</div>
                </a>
            </li>
        @endif

        {{--  exclusive nav-links --}}
        @if (Auth::guard('web')->user()->user_type == 'teacher')
            <li>
                <a
                    href="{{ route('assignments.index', App\Models\Teacher::where('user_id', Auth::guard('web')->user()->id)->first()->id) }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Assignments</div>
                </a>
            </li>
        @endif

        {{-- Logout --}}
        <li>
            <div class="parent-icon">

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="menu-title btn btn-link text-decoration-none text-secondary"><i
                            class="fadeIn animated bx bx-exit me-3"></i>{{ __('Logout') }}</button>
                </form>
            </div>
        </li>
        {{-- @dd(App\Models\Teacher::where('user_id', Auth::guard('web')->user()->id)->first()->id); --}}
    </ul>
    <!--end navigation-->
</div>
