<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rawData = document.getElementById('subjectsData').getAttribute('data-items');
        let allItems = [];
        try {
            allItems = JSON.parse(rawData);
        } catch (e) {
            console.error('Failed to parse subjects JSON:', e);
        }

        // Get inputs
        const codeSearch = document.getElementById('codeSearch');
        const nameSearch = document.getElementById('nameSearch');
        const typeSearch = document.getElementById('typeSearch');
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

        function truncateText(text, maxLength = 50) {
            if (!text) return '';
            return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
        }

        function renderTable() {
            const start = (currentPage - 1) * itemsPerPage;
            const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

            if (paginatedItems.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No subjects found.</td></tr>`;
                paginationContainer.innerHTML = '';
                return;
            }

            tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.code.toUpperCase()}</td>
                <td>${item.name}</td>
                <td>${truncateText(item.description)}</td>
                <td>${item.type.charAt(0).toUpperCase() + item.type.slice(1)}</td>
                <td>${item.credit_hours}</td>
                <td>
                    ${item.status === 'active'
                        ? '<span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</span>'
                        : '<span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</span>'}
                </td>
                <td>
                    <a href="{{ url('admin/subjects') }}/${item.id}/edit" class="btn btn-sm" title="Edit"><i class='bx bxs-edit'></i></a>
                    <form method="POST" action="{{ url('admin/subjects') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this subject?');">
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

            const prevLi = document.createElement('li');
            prevLi.className = currentPage === 1 ? 'disabled page-item' : 'page-item';
            prevLi.innerHTML = `<a href="#" class="page-link">&laquo;</a>`;
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
                li.className = currentPage === i ? 'active page-item' : 'page-item';
                li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
                li.addEventListener('click', e => {
                    e.preventDefault();
                    currentPage = i;
                    renderTable();
                });
                paginationContainer.appendChild(li);
            }

            const nextLi = document.createElement('li');
            nextLi.className = currentPage === pageCount ? 'disabled page-item' : 'page-item';
            nextLi.innerHTML = `<a href="#" class="page-link">&raquo;</a>`;
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
            const codeTerm = codeSearch.value.trim().toLowerCase();
            const nameTerm = nameSearch.value.trim().toLowerCase();
            const typeTerm = typeSearch.value;
            const statusTerm = statusSearch.value;

            filteredItems = allItems.filter(item =>
                (!codeTerm || item.code.includes(codeTerm)) &&
                (!nameTerm || item.name.includes(nameTerm)) &&
                (!typeTerm || item.type === typeTerm) &&
                (!statusTerm || item.status === statusTerm)
            );

            currentPage = 1;
            renderTable();
        }

        searchButton.addEventListener('click', filterItems);

        resetButton.addEventListener('click', () => {
            codeSearch.value = '';
            nameSearch.value = '';
            typeSearch.value = '';
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
