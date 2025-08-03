<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('teachersData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
        console.error('Error parsing teachers data:', e);
    }

    const nameSearch = document.getElementById('nameSearch');
    const emailSearch = document.getElementById('emailSearch');
    const subjectSearch = document.getElementById('subjectSearch');
    const gradeSearch = document.getElementById('gradeSearch');
    const genderSearch = document.getElementById('genderSearch');
    const statusSearch = document.getElementById('statusSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function truncateWithBadge(items) {
        if (items.length <= 2) {
            return items.join(', ');
        }
        const visible = items.slice(0, 2).join(', ');
        const remainder = items.length - 2;
        return `${visible} <span class="badge bg-secondary">+${remainder}</span>`;
    }

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const pageItems = filteredItems.slice(start, start + itemsPerPage);

        if (pageItems.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No teachers found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = pageItems.map(item => `
            <tr>
                <td>${item.name || 'N/A'}</td>
                <td>${item.email || 'N/A'}</td>
                <td>${truncateWithBadge(item.subjects)}</td>
                <td>${truncateWithBadge(item.grades)}</td>
                <td>${item.gender || 'N/A'}</td>
                <td>${item.salary}</td>

                
                <td>
                    <a href="{{ url('admin/teachers') }}/${item.id}/edit" class="btn btn-sm btn-primary me-1" title="Edit"><i class='bx bxs-edit'></i></a>
                    <form method="POST" action="{{ url('admin/teachers') }}/${item.id}" onsubmit="return confirm('Are you sure to delete?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class='bx bxs-trash'></i></button>
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

        for(let i=1; i <= pageCount; i++) {
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
            if(currentPage < pageCount) {
                currentPage++;
                renderTable();
            }
        });
        paginationContainer.appendChild(nextLi);
    }

    function filterItems() {
        const nameFilter = nameSearch.value.trim().toLowerCase();
        const emailFilter = emailSearch.value.trim().toLowerCase();
        const subjectFilter = subjectSearch.value.trim().toLowerCase();
        const gradeFilter = gradeSearch.value.trim().toLowerCase();
        const genderFilter = genderSearch.value;
        const statusFilter = statusSearch.value;

        filteredItems = allItems.filter(item =>
            (!nameFilter || (item.name && item.name.toLowerCase().includes(nameFilter))) &&
            (!emailFilter || (item.email && item.email.toLowerCase().includes(emailFilter))) &&
            (!subjectFilter || (item.subjects && item.subjects.some(s => s.toLowerCase().includes(subjectFilter)))) &&
            (!gradeFilter || (item.grades && item.grades.some(g => g.toLowerCase().includes(gradeFilter)))) &&
            (!genderFilter || item.gender === genderFilter) &&
            (statusFilter === '' || String(item.status) === statusFilter)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        nameSearch.value = '';
        emailSearch.value = '';
        subjectSearch.value = '';
        gradeSearch.value = '';
        genderSearch.value = '';
        statusSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    filteredItems = [...allItems];
    renderTable();
});
</script>
