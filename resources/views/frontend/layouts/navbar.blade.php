<nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ route('home') }}" class="navbar-brand p-0 d-flex">
        <img src="{{ asset('backend/assets/images/logo-icon.png') }}" alt="">
        <h1 class="display-6 m-0 pt-1 d-none d-lg-block">EduPulse</h1>
        {{--  <img src="{{ asset("assets/home/img/logo.png") }}" alt="Logo">  --}}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">About</a>
            <a href="#" class="nav-item nav-link">Services</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="#" class="dropdown-item">Features</a>
                    <a href="#" class="dropdown-item">Pricing</a>
                    <a href="#" class="dropdown-item">Blog</a>
                    <a href="#" class="dropdown-item">Testimonial</a>
                    <a href="#" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link">Contact Us</a>
        </div>
        <a href="{{ route("login") }}" class="btn btn-light border  rounded-pill text-primary py-2 px-4 me-4">Log
            In</a>
        <a href="{{ route('register') }}" class="btn btn-primary border rounded-pill text-white py-2 px-4">Sign Up</a>
    </div>
</nav>
