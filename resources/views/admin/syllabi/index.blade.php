@extends('admin.layouts.master')
@section('title', 'Syllabi List')
@section('content')

@php
    // Prepare the JSON data beforehand to avoid Blade parsing issues
    $syllabiJson = $syllabi->map(function ($syllabus) {
        return [
            'id' => $syllabus->id,
            'grade' => $syllabus->grade->name ?? '',
            'subject' => $syllabus->subject->name ?? '',
            'chapter_number' => $syllabus->chapter_number,
            'title' => $syllabus->title,
            'sub_topics' => $syllabus->sub_topics,
            'credit_hours' => $syllabus->credit_hours,
        ];
    });
@endphp

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Syllabi</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Syllabi</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.syllabi.create') }}" class="btn btn-primary">Add New Syllabus</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">
                <div class="col-md-3">
                    <input type="text" id="gradeSearch" class="form-control" placeholder="Search by Grade">
                </div>
                <div class="col-md-3">
                    <input type="text" id="subjectSearch" class="form-control" placeholder="Search by Subject">
                </div>
                <div class="col-md-2">
                    <input type="number" id="chapterSearch" class="form-control" placeholder="Chapter Number" min="1" />
                </div>
                <div class="col-md-3">
                    <input type="text" id="titleSearch" class="form-control" placeholder="Search by Title">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>
            </div>

            {{-- Hidden JSON data --}}
            <div id="syllabiData" data-items='@json($syllabiJson)' style="display:none;"></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Grade</th>
                            <th>Subject</th>
                            <th>Chapter Number</th>
                            <th>Title</th>
                            <th>Credit Hours</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Table rows rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination container injected by JS --}}

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('syllabiData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch (err) {
        console.error('Failed to parse syllabi JSON:', err);
    }

    const gradeSearch = document.getElementById('gradeSearch');
    const subjectSearch = document.getElementById('subjectSearch');
    const chapterSearch = document.getElementById('chapterSearch');
    const titleSearch = document.getElementById('titleSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let filteredItems = [...allItems];
    let currentPage = 1;

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const pageItems = filteredItems.slice(start, start + itemsPerPage);

        if (pageItems.length === 0) {
            tableBody.innerHTML =
                `<tr><td colspan="6" class="text-center">No syllabus records found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = pageItems.map(item => `
            <tr>
                <td>${item.grade}</td>
                <td>${item.subject}</td>
                <td>${item.chapter_number}</td>
                <td>${item.title}</td>
                <td>${item.credit_hours}</td>
                <td>
                    <a href="{{ url('admin/syllabi') }}/${item.id}" class="btn btn-sm" title="View"><i class="bx bxs-show"></i></a>
                    <a href="{{ url('admin/syllabi') }}/${item.id}/edit" class="btn btn-sm" title="Edit"><i class="bx bxs-edit"></i></a>
                    <form action="{{ url('admin/syllabi') }}/${item.id}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this syllabus?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm" title="Delete"><i class="bx bxs-trash"></i></button>
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

        // Previous
        const prevLi = document.createElement('li');
        prevLi.className = currentPage === 1 ? 'disabled page-item' : 'page-item';
        prevLi.innerHTML = '<a class="page-link" href="#">&laquo;</a>';
        prevLi.addEventListener('click', (e) => {
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
            li.className = i === currentPage ? 'active page-item' : 'page-item';
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener('click', e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });
            paginationContainer.appendChild(li);
        }

        // Next
        const nextLi = document.createElement('li');
        nextLi.className = currentPage === pageCount ? 'disabled page-item' : 'page-item';
        nextLi.innerHTML = '<a class="page-link" href="#">&raquo;</a>';
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
        const gradeVal = gradeSearch.value.trim().toLowerCase();
        const subjectVal = subjectSearch.value.trim().toLowerCase();
        const chapterVal = chapterSearch.value.trim();
        const titleVal = titleSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!gradeVal || (item.grade && item.grade.toLowerCase().includes(gradeVal))) &&
            (!subjectVal || (item.subject && item.subject.toLowerCase().includes(subjectVal))) &&
            (!chapterVal || item.chapter_number == chapterVal) &&
            (!titleVal || (item.title && item.title.toLowerCase().includes(titleVal)))
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        gradeSearch.value = '';
        subjectSearch.value = '';
        chapterSearch.value = '';
        titleSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    renderTable();
});
</script>
@endsection
