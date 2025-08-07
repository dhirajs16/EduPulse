<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('transactionsData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
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
        const start = (currentPage -1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if(paginatedItems.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No transactions found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>

                <td>${item.student_name}</td>
                <td>${item.fee_label}</td>
                <td>${formatAmount(item.actual_charges)}</td>
                <td>${formatAmount(item.amount_paid)}</td>
                <td>${item.payment_date}</td>
                <td>${(item.notes || '-').toString().slice(0, 30)}${item.notes && item.notes.length > 30 ? '...' : ''}</td>
                <td>
                    ${
                        parseFloat(item.actual_charges) === parseFloat(item.amount_paid)
                            ? `<span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">Paid</span>`
                            : parseFloat(item.actual_charges) > parseFloat(item.amount_paid)
                                ? `<span class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">Remaining</span>`
                                : `<span class="badge rounded-pill text-black bg-light-secondary p-2 text-uppercase px-3">Unknown</span>`
                    }
                </td>
                <td>
                    <a href="{{ url('admin/transactions') }}/${item.student_id}/edit/${item.id}" class="btn btn-sm" title="Edit">
                        <i class='bx bxs-edit'></i>
                    </a>
                    <form method="POST" action="{{ url('admin/transactions') }}/${item.student_id}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" title="Delete">
                            <i class='bx bxs-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>
        `).join('');

        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredItems.length / itemsPerPage);
        paginationContainer.innerHTML = '';

        if(pageCount <= 1) return;

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = currentPage === 1 ? 'disabled page-item' : 'page-item';
        prevLi.innerHTML = `<a class="page-link" href="#">&laquo;</a>`;
        prevLi.addEventListener('click', e => {
            e.preventDefault();
            if(currentPage > 1){
                currentPage--;
                renderTable();
            }
        });
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for(let i=1; i<=pageCount; i++){
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
            if(currentPage < pageCount){
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
