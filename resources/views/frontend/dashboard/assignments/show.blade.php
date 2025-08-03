@extends('frontend.dashboard.layouts.master')
@section('title', 'List Assignment')
@section('content')


<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Assignments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assignments</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            {{-- Search inputs --}}
            <div class="row g-3 mb-3 align-items-end">
                <div class="col-md-3">
                    <input type="text" id="titleSearch" class="form-control" placeholder="Search by Title">
                </div>
                <div class="col-md-3" hidden>
                    <input type="text" id="gradeSearch" class="form-control" placeholder="Search by Grade">
                </div>
                <div class="col-md-3">
                    <input type="text" id="subjectSearch" class="form-control" placeholder="Search by Subject">
                </div>
                <div class="col-md-2">
                    <select id="statusSearch" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" id="dueDateSearch" class="form-control" placeholder="Search by Due Date">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>
            </div>

            {{-- Hidden JSON data --}}
            <div id="assignmentsData" data-items='{!! $assignments->map(function ($assignment) {
                return [
                    "id" => $assignment->id,
                    "title" => $assignment->title,
                    "grade" => $assignment->grade->name ?? 'N/A',
                    "subject" => $assignment->subject->name ?? 'N/A',
                    "description" => $assignment->description ?? 'N/A',
                    "due_date" => $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d') : null,
                    "status" => $assignment->status,
                    "created_at" => $assignment->created_at->format('Y-m-d'),
                ];
            })->toJson() !!}' style="display:none;"></div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th hidden>Grade</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- JS renders rows here --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination controls injected here --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('assignmentsData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch (e) {
        console.error('Error parsing assignments data:', e);
    }

    const titleSearch = document.getElementById('titleSearch');
    const gradeSearch = document.getElementById('gradeSearch');
    const subjectSearch = document.getElementById('subjectSearch');
    const statusSearch = document.getElementById('statusSearch');
    const dueDateSearch = document.getElementById('dueDateSearch');

    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    // Pagination container
    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if (paginatedItems.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No assignments found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.title || 'N/A'}</td>
                <td hidden>${item.grade || 'N/A'}</td>
                <td>${item.subject || 'N/A'}</td>
                <td>${item.description || 'N/A'}</td>
                <td>${item.due_date || '-'}</td>
                <td>${item.status == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>'}</td>

            </tr>
        `).join('');

        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredItems.length / itemsPerPage);
        paginationContainer.innerHTML = '';

        if (pageCount <= 1) return;

        // Previous
        const prevLi = document.createElement('li');
        prevLi.className = currentPage === 1 ? 'disabled page-item' : 'page-item';
        prevLi.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
        prevLi.addEventListener('click', (e) => {
            e.preventDefault();
            if(currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for(let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = i === currentPage ? 'active page-item' : 'page-item';
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });
            paginationContainer.appendChild(li);
        }

        // Next
        const nextLi = document.createElement('li');
        nextLi.className = currentPage === pageCount ? 'disabled page-item' : 'page-item';
        nextLi.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
        nextLi.addEventListener('click', (e) => {
            e.preventDefault();
            if(currentPage < pageCount) {
                currentPage++;
                renderTable();
            }
        });
        paginationContainer.appendChild(nextLi);
    }

    function filterItems() {
        const titleVal = titleSearch.value.trim().toLowerCase();
        const gradeVal = gradeSearch.value.trim().toLowerCase();
        const subjectVal = subjectSearch.value.trim().toLowerCase();
        const statusVal = statusSearch.value;
        const dueDateVal = dueDateSearch.value;

        filteredItems = allItems.filter(item =>
            (!titleVal || (item.title && item.title.toLowerCase().includes(titleVal))) &&
            (!gradeVal || (item.grade && item.grade.toLowerCase().includes(gradeVal))) &&
            (!subjectVal || (item.subject && item.subject.toLowerCase().includes(subjectVal))) &&
            (statusVal === '' || String(item.status) === statusVal) &&
            (!dueDateVal || item.due_date === dueDateVal)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        titleSearch.value = '';
        gradeSearch.value = '';
        subjectSearch.value = '';
        statusSearch.value = '';
        dueDateSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    renderTable();
});
</script>
@endsection

