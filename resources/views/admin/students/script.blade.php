<script>
document.addEventListener('DOMContentLoaded', () => {
    // Parse JSON data
    const rawData = document.getElementById('studentsData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
        console.error('Failed to parse students JSON:', e);
    }

    // Input references
    const nameSearch = document.getElementById('nameSearch');
    // const fatherNameSearch = document.getElementById('fatherNameSearch');
    // const motherNameSearch = document.getElementById('motherNameSearch');
    const emailSearch = document.getElementById('emailSearch');
    const guardianNameSearch = document.getElementById('guardianNameSearch');
    const gradeSearch = document.getElementById('gradeSearch');

    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    // Pagination container setup
    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    // Truncate text utility
    function truncateText(text, maxLength = 20) {
        if (!text) return '';
        return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
    }

    // Render table rows for current page and filtered items
    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedItems = filteredItems.slice(start, start + itemsPerPage);

        if (paginatedItems.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="9" class="text-center">No students found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginatedItems.map(item => `
            <tr>
                <td>${item.id}</td>
                <td>
                    ${item.avatar
                        ? `<img src="${item.avatar}" alt="avatar" width="40" height="40" class="rounded-circle">`
                        : 'N/A'}
                </td>
                <td>${truncateText(item.full_name)}</td>
                <td>${truncateText(item.email)}</td>
                <td>${item.date_of_birth || 'N/A'}</td>
                <td>${truncateText(item.grade)}</td>
                <td>${truncateText(item.guardian_name)}</td>
                <td>
                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>N/A</div>
                </td>
                <td>
                    <a href="{{ url('admin/students') }}/${item.id}/edit" class="btn btn-sm me-1" title="Edit"><i class='bx bxs-edit'></i></a>
                    <form style="display:inline;" method="POST" action="{{ url('admin/students') }}/${item.id}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm" title="Delete"><i class='bx bxs-trash'></i></button>
                    </form>
                </td>
            </tr>
        `).join('');

        renderPagination();
    }

    // Render pagination controls
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
        for(let i=1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = (i === currentPage) ? 'active page-item' : 'page-item';
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

    // Filter items by search inputs (AND condition)
    function filterItems() {
        const nameTerm = nameSearch.value.trim().toLowerCase();
        const emailTerm = emailSearch.value.trim().toLowerCase();
        // const fatherTerm = fatherNameSearch.value.trim().toLowerCase();
        // const motherTerm = motherNameSearch.value.trim().toLowerCase();
        const guardianTerm = guardianNameSearch.value.trim().toLowerCase();
        const gradeTerm = gradeSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!nameTerm || (item.full_name && item.full_name.toLowerCase().includes(nameTerm))) &&
            // (!fatherTerm || (item.father_name && item.father_name.toLowerCase().includes(fatherTerm))) &&
            // (!motherTerm || (item.mother_name && item.mother_name.toLowerCase().includes(motherTerm))) &&
            (!emailTerm || (item.email && item.email.toLowerCase().includes(emailTerm))) &&
            (!guardianTerm || (item.guardian_name && item.guardian_name.toLowerCase().includes(guardianTerm))) &&
            (!gradeTerm || (item.grade && item.grade.toLowerCase().includes(gradeTerm)))
        );

        currentPage = 1;
        renderTable();
    }

    // Event listeners
    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        nameSearch.value = '';
        // fatherNameSearch.value = '';
        // motherNameSearch.value = '';
        emailSearch.value = '';
        guardianNameSearch.value = '';
        gradeSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial render
    filteredItems = [...allItems];
    renderTable();
});
</script>
