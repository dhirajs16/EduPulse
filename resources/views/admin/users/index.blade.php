@extends('admin.layouts.master')
@section('title', 'Users List')
@section('content')
<div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- Search inputs --}}
            <div class="row mb-3 g-3">
                <div class="col-md-3">
                    <input type="text" id="emailSearch" class="form-control" placeholder="Search by Email">
                </div>
                <div class="col-md-3">
                    <select id="userTypeSearch" class="form-select">
                        <option value="">All Types</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button id="searchButton" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetButton" class="btn btn-secondary flex-fill">Reset</button>
                </div>
            </div>

            {{-- Hidden JSON data --}}
            <div id="usersData" data-items='@json($users)' style="display:none;"></div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Email Verified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- JS will render rows here --}}
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
    const rawData = document.getElementById('usersData').getAttribute('data-items');
    let allItems = JSON.parse(rawData);
    const tableBody = document.querySelector('table tbody');

    const emailSearch = document.getElementById('emailSearch');
    const userTypeSearch = document.getElementById('userTypeSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');

    // Pagination container
    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3';
    tableBody.parentNode.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let filteredItems = [...allItems];
    let currentPage = 1;

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const pageItems = filteredItems.slice(start, start + itemsPerPage);

        if (pageItems.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4" class="text-center">No users found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = pageItems.map(item => `
            <tr>
                <td>${item.email}</td>
                <td>${item.user_type.charAt(0).toUpperCase() + item.user_type.slice(1)}</td>
                <td>${item.email_verified_at ? new Date(item.email_verified_at).toLocaleDateString() : '-'}</td>
                <td>
                    <a href="{{ url('admin/users') }}/${item.id}/edit" class="btn btn-sm" title="Edit"><i class="bx bxs-edit"></i></a>
                    <form method="POST" action="{{ url('admin/users') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm" type="submit" title="Delete"><i class="bx bxs-trash"></i></button>
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
        const emailVal = emailSearch.value.trim().toLowerCase();
        const userTypeVal = userTypeSearch.value;

        filteredItems = allItems.filter(item =>
            (!emailVal || (item.email && item.email.toLowerCase().includes(emailVal))) &&
            (!userTypeVal || item.user_type === userTypeVal)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        emailSearch.value = '';
        userTypeSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // initial render
    renderTable();
});
</script>
@endsection
