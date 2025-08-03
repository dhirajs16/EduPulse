<!doctype html>
<html lang="en">
<!--header start-->
@include('frontend.dashboard.layouts.meta_info')
<!--header end-->

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('frontend.dashboard.layouts.navbar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('frontend.dashboard.layouts.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!--end page wrapper -->
        @include('frontend.dashboard.layouts.footer')
    </div>
    @yield('script')
    <!--end wrapper-->
    @include('frontend.dashboard.layouts.footer_bottom')

</body>

</html>
