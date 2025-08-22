@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="page-content">

        {{-- top 4 dashboard options --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

            {{-- teachers --}}
            <div class="col">
                <a href="">
                    <div class="card radius-10 border-start border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Teachers</p>
                                    <h4 class="my-1 text-info">{{ \App\Models\Teacher::count() }}</h4>
                                    {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Students --}}
            <div class="col">
                <a href="{{ route('admin.profile') }}">
                    <div class="card radius-10 border-start border-0 border-4 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Students</p>
                                    <h4 class="my-1 text-warning">{{ \App\Models\Student::count() }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                        class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- assignments --}}
            <div class="col">
                <a href="">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Roles</p>
                                    <h4 class="my-1 text-danger">{{ 3 }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Events --}}
            <div class="col">
                <a href="">
                    <div class="card radius-10 border-start border-0 border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-success">{{ __('Events') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                        class="fadeIn animated bx bx-calendar-event"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Notices</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown"><i
                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="example_length" style="display: none;">
                                            <!-- Hidden length selector -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example_filter" class="dataTables_filter" style="display: none;">
                                            <!-- Hidden search filter -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered dataTable"
                                            style="width: 100%;" role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Publish Date" style="width: 141.2px;">Publish Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-label="Notice Title"
                                                        style="width: 220.2px;">Notice Title</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-label="Event Date"
                                                        style="width: 99.2px;">Event Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">2025-08-01</td>
                                                    <td>Announcement of Annual Sports Day Event Activities</td>
                                                    <td>2025-08-20</td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="sorting_1">2025-07-25</td>
                                                    <td>Schedule for Upcoming Parent-Teacher Meeting Sessions</td>
                                                    <td>2025-08-10</td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">2025-07-20</td>
                                                    <td>Registration Now Open for the Science Fair Event</td>
                                                    <td>2025-09-05</td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="sorting_1">2025-07-15</td>
                                                    <td>Educational Field Trip Planned to National Museum</td>
                                                    <td>2025-08-30</td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">2025-07-10</td>
                                                    <td>Holiday Notice Issued for Upcoming Teej Festival</td>
                                                    <td>2025-08-15</td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="sorting_1">2025-07-05</td>
                                                    <td>Workshop on Digital Learning Tools Announced</td>
                                                    <td>2025-08-18</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Latest Event') }}</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown"><i
                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;"></a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;"></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2 d-flex justify-content-center align-items-start">
                            <img src="{{ asset('defaults/quiz.png') }}" width="280px" alt=""
                                style="object-fit: cover">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            Name <span class="badge bg-success rounded-pill">Quiz Contest</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Organized By <span class="badge bg-danger rounded-pill">Grade 10 A</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Supervised By <span class="badge bg-primary rounded-pill">Mr. Ajay Mohan</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div><!--end row-->

    </div>
@endsection
