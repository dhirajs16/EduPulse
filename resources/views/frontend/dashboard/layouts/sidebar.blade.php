            <!-- ===================== Dashboard Sidebar Start ======================= -->

            <div class="dashboard-sidebar">
                <button type="button" class="dashboard-sidebar__close d-lg-none d-flex"><i
                        class="las la-times"></i></button>
                <div class="dashboard-sidebar__inner">
                    <a href="index.html" class="logo mb-48">
                        <img src="assets/images/logo/logo.png" alt="" class="white-version">
                    </a>
                    <a href="index.html" class="logo logo_icon favicon mb-48">
                        <img src="assets/images/thumbs/dashboard_sidebar_icon.png" alt="">
                    </a>

                    <!-- Sidebar List Start -->
                    <ul class="sidebar-list">
                        <li class="sidebar-list__item">
                            <a href="{{ route('dashboard') }}" class="sidebar-list__link">
                                <span class="sidebar-list__icon">
                                    <i class="ti ti-device-heart-monitor"></i>
                                </span>
                                <span class="text">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list__item">
                            <a href="{{ route('profile') }}" class="sidebar-list__link">
                                <span class="sidebar-list__icon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="text">{{ __('Profile') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list__item">
                            <a href="setting" class="sidebar-list__link">
                                <span class="sidebar-list__icon">
                                    <i class="ti ti-settings"></i>
                                </span>
                                <span class="text">{{ __('Settings') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list__item">
                            <a href="dashboard-table" class="sidebar-list__link">
                                <span class="sidebar-list__icon">
                                    <i class="ti ti-list-details"></i>
                                </span>
                                <span class="text">{{ __('Table Design') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-list__item">
                            <a href="dashboard-form.html" class="sidebar-list__link">
                                <span class="sidebar-list__icon">
                                    <i class="ti ti-list"></i>
                                </span>
                                <span class="text">Form Design</span>
                            </a>
                        </li>

                        {{-- logout option --}}
                        <li class="sidebar-list__item">
                            <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                @csrf
                                <a href="" class="sidebar-list__link"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="sidebar-list__icon">
                                        <i class="ti ti-logout"></i>
                                    </span>
                                    <span class="text">{{ __('Logout') }}</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- Sidebar List End -->

                </div>
            </div>
