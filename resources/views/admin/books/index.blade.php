@extends('admin.layouts.master')
@section('title', 'Books List')
@section('content')
<div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Books</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Books</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- Search --}}
            <div class="row mb-3 g-3">
                <div class="col-md-4">
                    <input type="text" id="searchTitle" class="form-control" placeholder="Search by Title">
                </div>
                <div class="col-md-4">
                    <input type="text" id="searchISBN" class="form-control" placeholder="Search by ISBN">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button id="searchBtn" class="btn btn-primary flex-fill">Search</button>
                    <button id="resetBtn" class="btn btn-secondary flex-fill">Reset</button>
                </div>
            </div>

            {{-- Hidden data --}}
            <div id="booksData" data-items='@json($books)' style="display:none;"></div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Publication Year</th>
                            <th>Publisher</th>
                            <th>Total Copies</th>
                            <th>Available Copies</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Rendered by JS --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination placeholder --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('booksData').getAttribute('data-items');
    let allItems = JSON.parse(rawData);
    const tableBody = document.querySelector('table tbody');
    const searchTitle = document.getElementById('searchTitle');
    const searchISBN = document.getElementById('searchISBN');
    const searchBtn = document.getElementById('searchBtn');
    const resetBtn = document.getElementById('resetBtn');

    // Pagination setup
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
            tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No books found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = pageItems.map(item => `
            <tr>
                <td>${item.title}</td>
                <td>${item.isbn}</td>
                <td>${item.category_name ?? '-'}</td>
                <td>${item.publication_year ?? '-'}</td>
                <td>${item.publisher ?? '-'}</td>
                <td>${item.total_copies}</td>
                <td>${item.available_copies}</td>
                <td>
                    <a href="{{ url('admin/books') }}/${item.id}/edit" class="btn btn-sm">Edit</a>
                    <form method="POST" action="{{ url('admin/books') }}/${item.id}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm">Delete</button>
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
            li.className = i === currentPage ? 'active page-item' : 'page-item';
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
        const titleVal = searchTitle.value.trim().toLowerCase();
        const isbnVal = searchISBN.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!titleVal || (item.title && item.title.toLowerCase().includes(titleVal))) &&
            (!isbnVal || (item.isbn && item.isbn.toLowerCase().includes(isbnVal)))
        );

        currentPage = 1;
        renderTable();
    }

    searchBtn.addEventListener('click', filterItems);
    resetBtn.addEventListener('click', () => {
        searchTitle.value = '';
        searchISBN.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    renderTable();
});
</script>
@endsection
