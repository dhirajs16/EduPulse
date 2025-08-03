@extends('frontend.dashboard.layouts.master')
@section('title', 'Time Table')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Timetable</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Grade ') . $grade->name . __(' Timetable') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="" class="btn btn-primary">Print TimeTable</a>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                @if ($timetables->isEmpty())
                    <div class="alert alert-info">No timetable entries found.</div>
                @else
                    @php
                        // Convert time strings to Carbon instances
                        $timetables->transform(function ($item) {
                            $item->start_time = \Carbon\Carbon::parse($item->start_time);
                            $item->end_time = \Carbon\Carbon::parse($item->end_time);
                            return $item;
                        });

                        // Define lunch slot
                        $lunchStart = \Carbon\Carbon::parse('12:30 PM');
                        $lunchEnd = \Carbon\Carbon::parse('01:00 PM');

                        // Create lunch slot object
                        $lunchSlot = (object) [
                            'start_time' => $lunchStart,
                            'end_time' => $lunchEnd,
                            'is_lunch' => true
                        ];

                        // Get unique time slots
                        $timeSlots = $timetables
                            ->unique(function ($item) {
                                return $item->start_time->format('H:i') . $item->end_time->format('H:i');
                            })
                            ->sortBy('start_time');

                        // Add lunch slot to time slots
                        $timeSlots->push($lunchSlot);
                        $timeSlots = $timeSlots->sortBy('start_time');

                        // Group by day
                        $groupedByDay = $timetables->groupBy('day');
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $slot)
                                    <tr>
                                        <td>
                                            {{ $slot->start_time->format('h:i A') }} -
                                            {{ $slot->end_time->format('h:i A') }}
                                        </td>

                                        @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                            <td>
                                                @if (isset($slot->is_lunch) && $slot->is_lunch)
                                                    <div class="timetable-entry">
                                                        <p class="text-secondary">LUNCH BREAK</p class="text-secondary">
                                                    </div>
                                                @else
                                                    @php
                                                        $entry = $groupedByDay
                                                            ->get($day, collect())
                                                            ->first(function ($item) use ($slot) {
                                                                return $item->start_time->eq($slot->start_time) &&
                                                                    $item->end_time->eq($slot->end_time);
                                                            });
                                                    @endphp

                                                    @if ($entry)
                                                        <div class="timetable-entry">
                                                            <strong>{{ $entry->subject->name }}</strong>
                                                            <div>{{ $entry->teacher->name }}</div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
