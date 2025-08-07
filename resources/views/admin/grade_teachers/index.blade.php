@extends('admin.layouts.master')
@section('title', 'Grade Teacher Assignments')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Grade Teachers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Assignments</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.grade_teachers.create') }}" class="btn btn-primary radius-30" style="background-color: #244960">
                <i class='bx bxs-plus-square'></i> Add Assignment
            </a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">
                <div class="col-md-3">
                    <select id="gradeSearch" class="form-select">
                        <option value="">Filter by Grade</option>
                        @foreach ($grades as $grade)
                            <option value="{{ strtolower($grade->name) }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="teacherSearch" class="form-select">
                        <option value="">Filter by Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ strtolower($teacher->name) }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="subjectSearch" class="form-select">
                        <option value="">Filter by Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ strtolower($subject->name) }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30" style="background-color: #244960">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div id="gradeTeachersData" data-items='{!! $gradeTeachers->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'grade' => strtolower($assignment->grade->name ?? ''),
                    'grade_name' => $assignment->grade->name ?? '',
                    'teacher' => strtolower($assignment->teacher->name ?? ''),
                    'teacher_name' => $assignment->teacher->name ?? '',
                    'subject' => strtolower($assignment->subject->name ?? ''),
                    'subject_name' => $assignment->subject->name ?? '',
                    'created_at' => $assignment->created_at ? $assignment->created_at->format('Y-m-d') : null,
                ];
            })->toJson() !!}' style="display:none;">
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Grade</th>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Created At</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container will be injected by JS --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('gradeTeachersData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch (e) {
        console.error('Failed to parse grade teacher JSON:', e);
    }

    const gradeSearch = document.getElementById('gradeSearch');
    const teacherSearch = document.getElementById('teacherSearch');
    const subjectSearch = document.getElementById('subjectSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3 justify-content-start';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if (paginatedItems.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="5" class="text-center">No assignments found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.grade_name}</td>
                <td>${item.teacher_name}</td>
                <td>${item.subject_name}</td>
                <td>${item.created_at || '-'}</td>
                <td>
                    <a href="{{ url('admin/grade_teachers') }}/${item.id}/edit" class="btn btn-sm" title="Edit">
                        <i class='bx bxs-edit'></i>
                    </a>
                    <form method="POST" action="{{ url('admin/grade_teachers') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" title="Delete"><i class='bx bxs-trash'></i></button>
                    </form>
                </td>
            </tr>
        `).join('');

        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredItems.length / itemsPerPage);
        paginationContainer.innerHTML = '';

        if (pageCount <= 1) return;

        // Prev button
        const prevLi = document.createElement('li');
        prevLi.className = currentPage === 1 ? 'disabled page-item' : 'page-item';
        prevLi.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
        prevLi.addEventListener('click', e => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = currentPage === i ? 'active page-item' : 'page-item';
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener('click', e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });
            paginationContainer.appendChild(li);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.className = currentPage === pageCount ? 'disabled page-item' : 'page-item';
        nextLi.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
        nextLi.addEventListener('click', e => {
            e.preventDefault();
            if (currentPage < pageCount) {
                currentPage++;
                renderTable();
            }
        });
        paginationContainer.appendChild(nextLi);
    }

    function filterItems() {
        const gradeTerm = gradeSearch.value.trim().toLowerCase();
        const teacherTerm = teacherSearch.value.trim().toLowerCase();
        const subjectTerm = subjectSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!gradeTerm || item.grade === gradeTerm) &&
            (!teacherTerm || item.teacher === teacherTerm) &&
            (!subjectTerm || item.subject === subjectTerm)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        gradeSearch.value = '';
        teacherSearch.value = '';
        subjectSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    filteredItems = [...allItems];
    renderTable();
});
</script>
@endsection
