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
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Profile</div>
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
            <a href="{{ route('admin.subjects.index') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Subjects</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.time-tables.index') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Time Tables</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.fee-types.index') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Fee Types</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.fees.index') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Fees</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.transactions.index') }}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Transactions</div>
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


    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
