<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('feeTypesData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
        console.error('Failed to parse fee types JSON:', e);
    }

    // Search inputs
    const nameSearch = document.getElementById('nameSearch');
    const descriptionSearch = document.getElementById('descriptionSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    // Pagination container created and inserted
    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3 justify-content-center';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 10;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function truncateText(text, maxLength = 30) {
        if (!text) return '';
        return text.length > maxLength ? text.substr(0, maxLength) + '...' : text;
    }

    function renderTable() {
        const start = (currentPage -1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if(paginatedItems.length === 0){
            tableBody.innerHTML = `<tr><td colspan="5" class="text-center">No fee types found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>${truncateText(item.description)}</td>
                <td>${item.created_at || '-'}</td>
                <td>
                    <a href="{{ url('admin/fee-types') }}/${item.id}/edit" class="btn btn-sm" title="Edit">
                        <i class='bx bxs-edit'></i>
                    </a>
                    <form method="POST" action="{{ url('admin/fee-types') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this fee type?');">
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

        // Previous
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
        for(let i =1; i<=pageCount; i++){
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

        // Next
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
        const nameTerm = nameSearch.value.trim().toLowerCase();
        const descriptionTerm = descriptionSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!nameTerm || (item.name && item.name.toLowerCase().includes(nameTerm))) &&
            (!descriptionTerm || (item.description && item.description.toLowerCase().includes(descriptionTerm)))
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        nameSearch.value = '';
        descriptionSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    filteredItems = [...allItems];
    renderTable();
});
</script>
