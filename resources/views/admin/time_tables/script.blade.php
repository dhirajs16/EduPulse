<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawData = document.getElementById('timeTablesData').getAttribute('data-items');
    let allItems = [];
    try {
        allItems = JSON.parse(rawData);
    } catch(e) {
        console.error('Failed to parse timetable JSON:', e);
    }

    const daySearch = document.getElementById('daySearch');
    const gradeSearch = document.getElementById('gradeSearch');
    const subjectSearch = document.getElementById('subjectSearch');
    const teacherSearch = document.getElementById('teacherSearch');
    const searchButton = document.getElementById('searchButton');
    const resetButton = document.getElementById('resetButton');
    const tableBody = document.querySelector('table tbody');

    const paginationContainer = document.createElement('ul');
    paginationContainer.className = 'pagination mt-3 justify-content-start';
    tableBody.parentElement.insertAdjacentElement('afterend', paginationContainer);

    const itemsPerPage = 8;
    let currentPage = 1;
    let filteredItems = [...allItems];

    function formatTimeRange(start, end) {
        return start.slice(0,5) + ' - ' + end.slice(0,5);
    }

    function renderTable() {
        const start = (currentPage-1)*itemsPerPage;
        const paginated = filteredItems.slice(start, start + itemsPerPage);

        if(paginated.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No timetable entries found.</td></tr>';
            paginationContainer.innerHTML = '';
            return;
        }

        tableBody.innerHTML = paginated.map(item => `
            <tr>
                <td>${item.day}</td>
                <td>${formatTimeRange(item.start_time, item.end_time)}</td>
                <td>${item.grade_name}</td>
                <td>${item.subject_name}</td>
                <td>${item.teacher_name}</td>
                <td>
                    <a href="{{ url('admin/time-tables') }}/${item.id}/edit" class="btn btn-sm" title="Edit">
                        <i class="bx bxs-edit"></i>
                    </a>
                    <form method="POST" action="{{ url('admin/time-tables') }}/${item.id}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this timetable entry?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" title="Delete">
                            <i class="bx bxs-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        `).join('');

        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredItems.length/itemsPerPage);
        paginationContainer.innerHTML = '';

        if(pageCount <= 1) return;

        const prevLi = document.createElement('li');
        prevLi.className = (currentPage === 1) ? 'disabled page-item' : 'page-item';
        prevLi.innerHTML = '<a href="#" class="page-link">&laquo;</a>';
        prevLi.onclick = e => {
            e.preventDefault();
            if(currentPage > 1){
                currentPage--;
                renderTable();
            }
        };
        paginationContainer.appendChild(prevLi);

        for(let i=1; i <= pageCount; i++){
            const li = document.createElement('li');
            li.className = (i === currentPage) ? 'active page-item' : 'page-item';
            li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
            li.onclick = e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            };
            paginationContainer.appendChild(li);
        }

        const nextLi = document.createElement('li');
        nextLi.className = (currentPage === pageCount) ? 'disabled page-item' : 'page-item';
        nextLi.innerHTML = '<a href="#" class="page-link">&raquo;</a>';
        nextLi.onclick = e => {
            e.preventDefault();
            if(currentPage < pageCount){
                currentPage++;
                renderTable();
            }
        }
        paginationContainer.appendChild(nextLi);
    }

    function filterItems() {
        const dayTerm = daySearch.value;
        const gradeTerm = gradeSearch.value.trim().toLowerCase();
        const subjectTerm = subjectSearch.value.trim().toLowerCase();
        const teacherTerm = teacherSearch.value.trim().toLowerCase();

        filteredItems = allItems.filter(item =>
            (!dayTerm || item.day === dayTerm) &&
            (!gradeTerm || (item.grade && item.grade.includes(gradeTerm))) &&
            (!subjectTerm || (item.subject && item.subject.includes(subjectTerm))) &&
            (!teacherTerm || (item.teacher && item.teacher.includes(teacherTerm)))
        );

        currentPage = 1;
        renderTable();
    }

    searchButton.addEventListener('click', filterItems);

    resetButton.addEventListener('click', () => {
        daySearch.value = '';
        gradeSearch.value = '';
        subjectSearch.value = '';
        teacherSearch.value = '';
        filteredItems = [...allItems];
        currentPage = 1;
        renderTable();
    });

    // Initial rendering
    renderTable();

});
</script>
