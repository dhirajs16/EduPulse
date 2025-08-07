@extends('frontend.layouts.master')
@section('content')
    <!-- Hero Header Start -->
    <div class="hero-header overflow-hidden px-5">
        <div class="rotate-img">
            {{-- <img src="{{ asset('assets/home/img/school-bg.png') }}" class="img-fluid w-100" alt="EduPulse School Management"> --}}
            <div class="rotate-sty-2"></div>
        </div>
        <div class="row gy-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">Transform Your School with EduPulse
                </h1>
                <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">The complete School ERP solution for Birgunj schools -
                    automating administration, academics, and communication.</p>


                @if (!Auth::check())
                    <a href="#" class="btn btn-primary border rounded-pill py-3 px-5 wow fadeInUp"
                        data-wow-delay="0.1s">Request Free Demo</a>
                    <a href="{{ route('login') }}" class="btn btn-primary border  rounded-pill py-3 px-5 wow fadeInUp ms-2"
                        data-wow-delay="0.1s">Log In</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-primary border  rounded-pill py-3 px-5 wow fadeInUp ms-2">Dashboard</a>
                @endif
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <img src="{{ asset('assets/home/img/blog-1.png') }}" class="img-fluid w-100 h-100" alt="EduPulse Dashboard">
            </div>
        </div>
    </div>


    <!-- Hero Header End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- Trusted Schools Start -->
    <div class="container-fluid py-4 bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <p class="mb-0">All in one solution for Schools.</p>
                <h1>EduPulse</h1>
            </div>
            {{-- <div class="row g-4 justify-content-center align-items-center">
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('assets/home/img/school-logo1.png') }}" class="img-fluid" alt="Birgunj Public School" style="max-height: 60px;">
                </div>
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('assets/home/img/school-logo2.png') }}" class="img-fluid" alt="Gandaki Boarding School" style="max-height: 60px;">
                </div>
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('assets/home/img/school-logo3.png') }}" class="img-fluid" alt="Nepal English School" style="max-height: 60px;">
                </div>
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('assets/home/img/school-logo4.png') }}" class="img-fluid" alt="Paramount Academy" style="max-height: 60px;">
                </div>
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('assets/home/img/school-logo5.png') }}" class="img-fluid" alt="Shishu Niketan" style="max-height: 60px;">
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Trusted Schools End -->

    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5" style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="RotateMoveLeft">
                        <img src="{{ asset('assets/home/img/about-1.png') }}" class="img-fluid w-100"
                            alt="School Management System">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-1" style="color: #1b3e53">About EduPulse</h4>
                    <h1 class="display-5 mb-4">Complete School Management Solution</h1>
                    <p class="mb-4">EduPulse is a comprehensive School ERP system designed specifically for educational
                        institutions in Birgunj, Nepal. Our platform simplifies school administration, enhances academic
                        management, and improves communication between teachers, students, and parents.
                    </p>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Centralized Administration</h5>
                            <p class="mb-0">Manage all school operations from a single platform</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Birgunj-Focused Solution</h5>
                            <p class="mb-0">Built to address the specific needs of schools in our region</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Affordable & Scalable</h5>
                            <p class="mb-0">Solutions for schools of all sizes and budgets</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary border rounded-pill py-3 px-5 mt-4">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1" style="color: #f4a02a">Our Modules</h4>
                <h1 class="display-5 mb-4">Comprehensive School Management Features</h1>
                <p class="mb-0">EduPulse provides all the tools you need to efficiently manage your educational
                    institution. From student admissions to examination results, we've got you covered.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i
                                class="fas fa-user-graduate fa-5x" style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Student Management</h4>
                            <p class="mb-4">Complete student profiles, attendance tracking, and academic records
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i
                                class="fas fa-chalkboard-teacher fa-5x" style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Teacher Management</h4>
                            <p class="mb-4">Manage teacher schedules, workloads, and performance metrics
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i
                                class="fas fa-file-invoice-dollar fa-5x" style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Fee Management</h4>
                            <p class="mb-4">Automated fee collection, receipts, and financial reporting
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-book fa-5x"
                                style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Academic Management</h4>
                            <p class="mb-4">Curriculum planning, timetable scheduling, and exam management
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i
                                class="fas fa-bus fa-5x " style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Transport Management</h4>
                            <p class="mb-4">Bus routes, vehicle tracking, and transportation scheduling
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-users fa-5x "
                                style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Student Portal</h4>
                            <p class="mb-4">Real-time updates on student progress, attendance, and school events
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-laptop fa-5x "
                                style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">E-Learning</h4>
                            <p class="mb-4">Mock Test, assignments, and digital resource sharing
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i
                                class="fas fa-chart-line fa-5x " style="color: #f4a02a"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">Reporting & Analytics</h4>
                            <p class="mb-4">Comprehensive reports for informed decision-making
                            </p>
                            <a href="#" class="btn btn-light rounded-pill text-primary py-2 px-4">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Why Choose Us Start -->
    <div class="container-fluid feature overflow-hidden py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h4 class="" style="color: #1b3e53">Why Choose EduPulse</h4>
                    <h1 class="display-5 mb-4">Designed for Birgunj Schools</h1>
                    <p class="mb-4">Our school management system is built with the specific needs of educational
                        institutions in Birgunj in mind. We understand the local challenges and have created solutions that
                        work for our community.</p>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Local Expertise</h5>
                            <p>Developed by educators and technologists from Birgunj</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Quick Implementation</h5>
                            <p>Get your school operational on EduPulse within 2 weeks</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square rounded-circle"
                            style="width: 64px; height: 64px; background-color: #1b3e53">
                            <i class="fas fa-headset text-white"></i>
                        </div>
                        <div class="ms-4">
                            <h5>Local Support</h5>
                            <p>Dedicated support team based in Birgunj</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="bg-white rounded p-4 shadow">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-3" style=" background-color: #1b3e53">
                                        <i class="fas fa-school fa-2x text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4 class="mb-1">Schools</h4>
                                        <p class="mb-0">In Birgunj and surrounding areas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white rounded p-4 shadow">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-3" style=" background-color: #1b3e53">
                                        <i class="fas fa-users fa-2x text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4 class="mb-1">Users</h4>
                                        <p class="mb-0">Students, teachers and parents</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white rounded p-4 shadow">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-3" style=" background-color: #1b3e53">
                                        <i class="fas fa-sync fa-2x text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4 class="mb-1">Renewal Rate</h4>
                                        <p class="mb-0">Schools continue with EduPulse year after year</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-white rounded p-4 shadow">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-3" style=" background-color: #1b3e53">
                                        <i class="fas fa-smile fa-2x text-white"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h4 class="mb-1">Satisfaction</h4>
                                        <p class="mb-0">From school administrators and staff</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us End -->

    <!-- Mobile App Start -->
    {{-- <div class="container-fluid overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <img src="{{ asset('assets/home/img/mobile-app.png') }}" class="img-fluid" alt="EduPulse Mobile App">
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <h4 class="text-primary">Mobile Experience</h4>
                    <h1 class="display-5 mb-4">School Management On The Go</h1>
                    <p class="mb-4">Access EduPulse anytime, anywhere through our dedicated mobile applications for administrators, teachers, students, and parents.</p>

                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5>Real-time Updates</h5>
                                    <p class="mb-0">Instant notifications for attendance, assignments, and events</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5>Offline Access</h5>
                                    <p class="mb-0">Work without internet connectivity in remote areas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5>Multi-language</h5>
                                    <p class="mb-0">Support for Nepali, Maithili, Bhojpuri, and English</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h5>Low Data Usage</h5>
                                    <p class="mb-0">Optimized for areas with limited internet connectivity</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="#" class="me-3">
                            <img src="{{ asset('assets/home/img/google-play.png') }}" alt="Google Play" style="height: 60px;">
                        </a>
                        <a href="#">
                            <img src="{{ asset('assets/home/img/app-store.png') }}" alt="App Store" style="height: 60px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Mobile App End -->

    <!-- Testimonials Start -->
    <div class="container-fluid testimonial py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="" style="color: #1b3e53">Testimonials</h4>
                <h1 class="display-5 mb-4">What Birgunj Schools Say About EduPulse</h1>
                <p class="mb-0">Hear from educational institutions in our community that have transformed their
                    operations with our school management system.
                </p>
            </div>
            <div class="testimonial-carousel owl-carousel wow zoomInDown" data-wow-delay="0.2s">
                <div class="testimonial-item"
                    data-dot="<img class='img-fluid' src='assets/home/img/testimonial-1.jpg' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4"
                                style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('assets/home/img/testimonial-1.jpg') }}"
                                    class="img-fluid rounded-circle" alt="Principal Sharma">
                            </div>
                            <div>
                                <h5 class="mb-2">Rajesh Sharma</h5>
                                <p class="mb-0">Principal, Birgunj Public School</p>
                            </div>
                        </div>
                        <p class="fs-7">"EduPulse has revolutionized how we manage our school. From automated attendance
                            to seamless communication with parents, it has saved us countless hours of administrative work.
                            The local support team in Birgunj is always responsive to our needs."
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item"
                    data-dot="<img class='img-fluid' src='assets/home/img/testimonial-2.jpg' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4"
                                style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('assets/home/img/testimonial-2.jpg') }}"
                                    class="img-fluid rounded-circle" alt="Administrator Kaur">
                            </div>
                            <div>
                                <h5 class="mb-2">Priya Kaur</h5>
                                <p class="mb-0">Administrator, Gandaki Boarding School</p>
                            </div>
                        </div>
                        <p class="fs-7">"The fee management module alone has been worth the investment. No more manual
                            calculations or chasing payments. Parents appreciate the transparency, and our accounting team
                            has seen a 70% reduction in their workload. A must-have for schools in Birgunj!"
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item"
                    data-dot="<img class='img-fluid' src='assets/home/img/testimonial-3.jpg' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4"
                                style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('assets/home/img/testimonial-3.jpg') }}"
                                    class="img-fluid rounded-circle" alt="Teacher Yadav">
                            </div>
                            <div>
                                <h5 class="mb-2">Sanjay Yadav</h5>
                                <p class="mb-0">Teacher, Nepal English School</p>
                            </div>
                        </div>
                        <p class="fs-7">"As a teacher, the academic management features have transformed how I plan
                            lessons and track student progress. The mobile app is particularly useful for updating
                            attendance during school trips around Birgunj. EduPulse understands the needs of Nepali
                            educators."
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials End -->

    <!-- CTA Start -->
    <div class="container-fluid py-5" style="background-color: #f4a02a">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 text-white mb-4">Ready to Transform Your School?</h1>
                    <p class="fs-4 text-white mb-4">Join the growing community of educational institutions in Birgunj that
                        are using EduPulse to streamline their operations.</p>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-light rounded-pill py-3 px-5 me-3">Request Free Demo</a>
                        <a href="" class="btn btn-outline-light rounded-pill py-3 px-5">Contact
                            Sales</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA End -->
@endsection
