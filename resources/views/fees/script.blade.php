<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('feesData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch (e) {
        console.error('Failed to parse fees JSON:', e);
    }

    const feeTypeSearch = document.getElementById('feeTypeSearch');
    const gradeSearch = document.getElementById('gradeSearch');
    const yearSearch = document.getElementById('yearSearch');
    const monthSearch = document.getElementById('monthSearch');
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
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center">No fees found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.id}</td>
                <td>${item.fee_type_name}</td>
                <td>${item.grade_name}</td>
                <td>${formatAmount(item.amount)}</td>
                <td>${item.year}</td>
                <td>${item.month}</td>
                <td>${item.created_at || '-'}</td>
                <td>
                    <a href="{{ url('admin/fees') }}/${item.id}/edit" class="btn btn-sm" title="Edit"><i class='bx bxs-edit'></i></a>
                    <form method="POST" action="{{ url('admin/fees') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this fee?');">
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
        const feeTypeTerm = feeTypeSearch.value.trim().toLowerCase();
        const gradeTerm = gradeSearch.value.trim().toLowerCase();
        const yearTerm = yearSearch.value.trim();
        const monthTerm = monthSearch.value.trim();

        filteredItems = allItems.filter(item =>
            (!feeTypeTerm || item.fee_type === feeTypeTerm) &&
            (!gradeTerm || item.grade === gradeTerm) &&
            (!yearTerm || item.year == yearTerm) &&
            (!monthTerm || item.month == monthTerm)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        feeTypeSearch.value = '';
        gradeSearch.value = '';
        yearSearch.value = '';
        monthSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    filteredItems = [...allItems];
    renderTable();
});
</script>
