@extends('frontend.dashboard.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="page-content">
        <div class="d-flex gap-5">
            <p class="pb-2 font-bold">Grade: {{ $grade->name }}</p>
            <p class="pb-2 font-bold">Subject: {{ $subject->name }}</p>
            <p class="pb-2 font-bold">Credit Hour: {{ $subject->credit_hours }}</p>

        </div>
        <div class="card col-md-7">
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 100px;">Chapters</th>
                            <th scope="col">Topic</th>
                            <th scope="col">Sub-Topics</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($syllabi as $syllabus)
                        <tr>
                            <th>Chaper: {{ $syllabus->chapter_number }}</th>
                            <th>{{ $syllabus->title }}</th>
                            <td>{{ $syllabus->sub_topics }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://unpkg.com/@vapi-ai/client-sdk-react/dist/embed/widget.umd.js" async type="text/javascript">
        </script>

        <vapi-widget public-key="4ff8a9f0-dfc5-43ef-85f3-49e7d4d53fbb" assistant-id="97e8b5af-cf85-487b-9d45-1865cb7f4b0f"
            mode="chat" theme="light" main-label="Ask Instructor" start-button-text="Start Voice Chat"
            end-button-text="End Call" empty-chat-message="Hi! How can I help you with your studies today?"></vapi-widget>
    </div>


@endsection
