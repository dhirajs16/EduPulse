<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text" style="color: #244960;">EduPulse</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('home') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile') }}">
                <div class="parent-icon"><i class='bx bx-user-circle'></i>
                </div>
                <div class="menu-title">Profile</div>
            </a>
        </li>

        {{-- admin exclusive nav links --}}
        @if (auth()->guard('admin')->user() && auth()->guard('admin')->user()->hasRole('super admin'))
            <li class="menu-label">{{ __('User Management') }}</li>
            <li>
                <a href="{{ route('admin.users.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.students.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Students</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teachers.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Teachers</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.role-users.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Role Users</div>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.roles.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Roles & Permissions</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.request_demos.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Demo Request List</div>
                </a>
            </li>

            <li class="menu-label">{{ __('Academics Management') }}</li>
            <li>
                <a href="{{ route('admin.subjects.index') }}">
                    <div class="parent-icon"><i class='fadeIn animated bx bx-book-bookmark'></i>
                    </div>
                    <div class="menu-title">Subjects</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.syllabi.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Syllabi</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.grade_teachers.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Subject Teachers</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.time-tables.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Time Tables</div>
                </a>
            </li>
        @endif


        {{-- accountant exclusive nav links --}}
        @if (auth()->guard('admin')->user() &&
                (auth()->guard('admin')->user()->hasAnyRole(['super admin', 'accountant']) ||
                    auth()->guard('admin')->user()->hasAnyPermission(['manage accounts'])))
            <li class="menu-label">{{ __('Fee Management') }}</li>

            <li>
                <a href="{{ route('admin.fees.index') }}">
                    <div class="parent-icon"><i class='fadeIn animated bx bx-money'></i>
                    </div>
                    <div class="menu-title">Fees</div>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.transactions.index') }}">
                    <div class="parent-icon"><i class='bx bx-category'></i>
                    </div>
                    <div class="menu-title">Transactions</div>
                </a>
            </li> --}}
        @endif




        @if (auth()->guard('admin')->user() &&
                (auth()->guard('admin')->user()->hasAnyRole(['super admin', 'librarian']) ||
                    auth()->guard('admin')->user()->hasAnyPermission(['manage library'])))
            <li class="menu-label">{{ __('Library Management') }}</li>
            <li>
                <a href="{{ route('admin.books.index') }}">
                    <div class="parent-icon"><i class='bx bx-book'></i>
                    </div>
                    <div class="menu-title">Books</div>
                </a>
            </li>
        @endif


        <li class="menu-label">{{ __('Sign Out') }}</li>
        <li>
            <div class="parent-icon">

                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button class="menu-title btn btn-link text-decoration-none text-secondary"><i
                            class="fadeIn animated bx bx-exit me-3"></i>{{ __('Logout') }}</button>
                </form>
            </div>
        </li>

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
