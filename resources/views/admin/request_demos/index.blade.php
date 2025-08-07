@extends('admin.layouts.master')
@section('title', 'Request Demo List')
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Request Demos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request Demos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row align-items-end mb-3 g-3">
                <div class="col-md-4">
                    <input type="text" id="schoolNameSearch" class="form-control" placeholder="Search by School Name">
                </div>

                <div class="col-md-4">
                    <input type="text" id="emailSearch" class="form-control" placeholder="Search by Email">
                </div>

                <div class="col-md-4">
                    <select id="statusSearch" class="form-select">
                        <option value="">Filter by Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="col-md-12 d-flex gap-2 mt-2">
                    <button id="searchButton" class="btn btn-primary flex-fill radius-30" style="background-color: #244960">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                </div>
            </div>

            {{-- Hidden data container with JSON data --}}
            <div id="requestsData" data-items='{!! $requests->map(function ($requestDemo) {
                return [
                    'id' => $requestDemo->id,
                    'school_name' => strtolower($requestDemo->school_name ?? ''),
                    'email' => strtolower($requestDemo->email ?? ''),
                    'phone' => $requestDemo->country_code . ' ' . $requestDemo->phone,
                    'status' => strtolower($requestDemo->status),
                    'created_at' => $requestDemo->created_at ? $requestDemo->created_at->format('Y-m-d') : null,
                ];
            })->toJson() !!}' style="display:none;"></div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>School Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Requested At</th>
                            <th style="width: 110px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rows rendered by JS --}}
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
    const rawData = document.getElementById('requestsData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch (e) {
        console.error('Failed to parse request demos JSON:', e);
    }

    const schoolNameSearch = document.getElementById('schoolNameSearch');
    const emailSearch = document.getElementById('emailSearch');
    const statusSearch = document.getElementById('statusSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3 justify-content-center';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if (paginatedItems.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center">No requests found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.school_name}</td>
                <td>${item.email}</td>
                <td>${item.phone}</td>
                <td>
                    <span class="badge ${
                        item.status === 'pending' ? 'bg-warning' :
                        item.status === 'approved' ? 'bg-success' :
                        item.status === 'rejected' ? 'bg-danger' : ''
                    } text-capitalize">
                        ${item.status}
                    </span>
                </td>
                <td>${item.created_at || '-'}</td>
                <td>
                    <a href="{{ url('admin/request_demos') }}/${item.id}" class="btn btn-sm btn-primary">View</a>
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
        const schoolNameTerm = schoolNameSearch.value.trim().toLowerCase();
        const emailTerm = emailSearch.value.trim().toLowerCase();
        const statusTerm = statusSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!schoolNameTerm || item.school_name.includes(schoolNameTerm)) &&
            (!emailTerm || item.email.includes(emailTerm)) &&
            (!statusTerm || item.status === statusTerm)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        schoolNameSearch.value = '';
        emailSearch.value = '';
        statusSearch.value = '';
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
