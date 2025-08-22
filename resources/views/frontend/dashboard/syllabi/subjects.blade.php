@extends('frontend.dashboard.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="page-content">

        {{-- top 4 dashboard options --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            {{-- Science --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 6]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-warning">{{ __('Science') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                    <i class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- English --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 2]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-primary">{{ __('English') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-primary text-white ms-auto">
                                    <i class='bx bx-book'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Mathematics --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 1]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-danger">{{ __('Mathematics') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                    <i class='bx bx-calculator'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Nepali --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 3]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-success">{{ __('Nepali') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                    <i class='bx bx-book-open'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Social Studies --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 5]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-info">{{ __('Social Studies') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                    <i class='bx bx-globe'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- GK --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 7]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-secondary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-secondary">{{ __('GK') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                    <i class='bx bx-laptop'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Health --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 8]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-dark">{{ __('Health') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-moonlit text-white ms-auto">
                                    <i class='bx bx-heart'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Moral Education --}}
            <div class="col">
                <a href="{{ route('syllabi.details', ['grade' => Auth::user()->student->grade->id, 'subject' => 9]) }}">
                    <div class="card radius-10 border-start border-0 border-4 border-pink">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1" style="color:#e83e8c">{{ __('Acconts') }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-pink text-white ms-auto">
                                    <i class='bx bx-calculator'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




        </div>
    </div>

@endsection
