<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('teachersData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
        console.error('Failed to parse teachers JSON:', e);
    }

    const nameSearch = document.getElementById('nameSearch');
    const emailSearch = document.getElementById('emailSearch');
    const genderSearch = document.getElementById('genderSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3 justify-content-center';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function truncateText(text, maxLength = 30) {
        if (!text) return '';
        return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
    }

    // Format items list: show first two with comma, then +N badge
    function formatWithBadge(items) {
        if (!items || items.length === 0) return '';
        if (items.length <= 2) {
            return items.join(', ');
        }
        const visible = items.slice(0, 2).join(', ');
        const remaining = items.length - 2;
        return `${visible} <span class="badge rounded-circle bg-success ms-1" style="font-size:0.8em; vertical-align: middle;">+${remaining}</span>`;
    }

    function renderTable() {
        const start = (currentPage - 1) * itemsPerPage;
        const paginated = filteredItems.slice(start, start + itemsPerPage);

        if (!paginated.length) {
            tableBody.innerHTML = `<tr><td colspan="9" class="text-center">No teachers found.</td></tr>`;
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginated.map(item => `
            <tr>
                <td>${item.id}</td>
                <td>${item.avatar ? `<img src="${item.avatar}" alt="avatar" width="40" height="40" class="rounded-circle">` : 'N/A'}</td>
                <td>${truncateText(item.full_name)}</td>
                <td>${item.gender.charAt(0).toUpperCase() + item.gender.slice(1)}</td>
                <td>${item.user_email}</td>
                <td>${truncateText(item.contact)}</td>
                <td>${formatWithBadge(item.subjects)}</td>
                <td>${formatWithBadge(item.grades)}</td>
                <td>
                    <a href="{{ url('admin/teachers') }}/${item.id}/edit" class="btn btn-sm btn-primary me-1" title="Edit"><i class="bx bxs-edit"></i></a>
                    <form method="POST" action="{{ url('admin/teachers') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="bx bxs-trash"></i></button>
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
        prevLi.innerHTML = `<a href="#" class="page-link">&laquo;</a>`;
        prevLi.onclick = e => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        };
        paginationContainer.appendChild(prevLi);

        // Pages
        for(let i=1; i <= pageCount; i++){
            const li = document.createElement('li');
            li.className = i === currentPage ? 'active page-item' : 'page-item';
            li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
            li.onclick = e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            };
            paginationContainer.appendChild(li);
        }

        // Next
        const nextLi = document.createElement('li');
        nextLi.className = currentPage === pageCount ? 'disabled page-item' : 'page-item';
        nextLi.innerHTML = `<a href="#" class="page-link">&raquo;</a>`;
        nextLi.onclick = e => {
            e.preventDefault();
            if (currentPage < pageCount) {
                currentPage++;
                renderTable();
            }
        };
        paginationContainer.appendChild(nextLi);
    }

    function filterItems() {
        const nameTerm = nameSearch.value.trim().toLowerCase();
        const emailTerm = emailSearch.value.trim().toLowerCase();
        const genderTerm = genderSearch.value;

        filteredItems = allItems.filter(item =>
            (!nameTerm || (item.full_name && item.full_name.toLowerCase().includes(nameTerm))) &&
            (!emailTerm || (item.user_email && item.user_email.includes(emailTerm))) &&
            (!genderTerm || item.gender === genderTerm)
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        nameSearch.value = '';
        emailSearch.value = '';
        genderSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial display
    renderTable();
});
</script>
