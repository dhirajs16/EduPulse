@extends('frontend.dashboard.layouts.master')
@section('title', 'Transactions List')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Transactions</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $student->name }}'s Transactions</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                {{-- Search inputs --}}
                <div class="row align-items-end mb-3 g-3">

                    {{-- <div class="col-md-3">
                    <select id="studentSearch" class="form-select">
                        <option value="">Filter by Student</option>
                        @foreach ($students as $student)
                            <option value="{{ strtolower($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}">
                                {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                    <div class="col-md-3">
                        <select id="feeSearch" class="form-select">
                            <option value="">Filter by Fee</option>
                            @foreach ($fees as $fee)
                                <option value="{{ $fee->id }}">{{ $fee->name ?? 'N/A' }} -
                                    {{ $fee->grade->name ?? 'N/A' }} ({{ $fee->year }}/{{ $fee->month }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2" hidden>

                        <input type="date" id="paymentDateSearch" class="form-control"
                            placeholder="Filter by Payment Date">
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button id="searchButton" class="btn btn-primary flex-fill radius-30"
                            style="background-color: #244960;">Search</button>
                        <button id="resetButton" class="btn btn-secondary flex-fill radius-30">Reset</button>
                    </div>
                </div>

                {{-- Hidden data container with JSON data --}}
                <div id="transactionsData" data-items='{!! $transactions->map(function ($tx) {
                        $studentName = trim($tx->student->first_name . ' ' . $tx->student->middle_name . ' ' . $tx->student->last_name);
                        return [
                            'id' => $tx->id,
                            'student_id' => $tx->student_id,
                            'student_name' => $studentName,
                            'fee_id' => $tx->fee_id,
                            'fee_label' =>
                                $tx->fee->name ??
                                'N/A' . ' - ' . ($tx->fee->grade->name ?? 'N/A') . ' (' . $tx->fee->year . '/' . $tx->fee->month . ')',
                            'actual_charges' => $tx->fee->amount,
                            'amount_paid' => $tx->amount_paid,
                            'payment_date' => \Carbon\Carbon::parse($tx->payment_date)->format('Y-m-d'),
                            'fee_month' => $tx->fee->month,
                            'fee_year' => $tx->fee->year,
                        ];
                    })->toJson() !!}' style="display:none;"></div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Fee</th>
                                <th>Actual Charge</th>
                                <th>Amount Paid</th>
                                <th hidden>Payment Date</th>
                                <th>Month/Year</th>
                                <th>Status</th>
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
            const rawData = document.getElementById('transactionsData').getAttribute('data-items');
            let allItems = [];
            try {
                allItems = JSON.parse(rawData);
            } catch (e) {
                console.error('Failed to parse transactions JSON', e);
            }

            // const studentSearch = document.getElementById('studentSearch');
            const feeSearch = document.getElementById('feeSearch');
            const paymentDateSearch = document.getElementById('paymentDateSearch');
            const searchButton = document.getElementById('searchButton');
            const resetButton = document.getElementById('resetButton');
            const tableBody = document.querySelector('table tbody');

            const paginationContainer = document.createElement('ul');
            paginationContainer.className = 'pagination mt-3 justify-content-center';
            tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

            const itemsPerPage = 8;
            let currentPage = 1;
            let filteredItems = [...allItems];

            function formatAmount(amount) {
                return parseFloat(amount).toFixed(2);
            }

            function renderTable() {
                const start = (currentPage - 1) * itemsPerPage;
                const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

                if (paginatedItems.length === 0) {
                    tableBody.innerHTML =
                    `<tr><td colspan="7" class="text-center">No transactions found.</td></tr>`;
                    paginationContainer.innerHTML = '';
                    return;
                }

                tableBody.innerHTML = paginatedItems.map(item => `
            <tr>

                <td>${item.student_name}</td>
                <td>${item.fee_label}</td>
                <td>${formatAmount(item.actual_charges)}</td>
                <td>${formatAmount(item.amount_paid)}</td>
                <td hidden>${item.payment_date}</td>
                <td>${item.fee_month}/${item.fee_year}</td>
                <td>
                    ${
                        parseFloat(item.actual_charges) === parseFloat(item.amount_paid)
                            ? `<span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">Paid</span>`
                            : parseFloat(item.actual_charges) > parseFloat(item.amount_paid)
                                ? `<span class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">Remaining</span>`
                                : `<span class="badge rounded-pill text-black bg-light-secondary p-2 text-uppercase px-3">Unknown</span>`
                    }
                </td>

            </tr>
        `).join('');

                renderPagination();
            }


            function renderPagination() {
                const pageCount = Math.ceil(filteredItems.length / itemsPerPage);
                paginationContainer.innerHTML = '';

                if (pageCount <= 1) return;

                // Previous button
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
                // const studentTerm = studentSearch.value.trim().toLowerCase();
                const feeTerm = feeSearch.value.trim();
                const paymentDateTerm = paymentDateSearch.value.trim();

                filteredItems = allItems.filter(item =>
                    // (!studentTerm || item.student_name.includes(studentTerm)) &&
                    (!feeTerm || String(item.fee_id) === feeTerm) &&
                    (!paymentDateTerm || item.payment_date === paymentDateTerm)
                );

                currentPage = 1;
                renderTable();
            }

            searchButton.addEventListener('click', filterItems);

            resetButton.addEventListener('click', () => {
                // studentSearch.value = '';
                feeSearch.value = '';
                paymentDateSearch.value = '';
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
