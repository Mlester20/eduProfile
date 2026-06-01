function viewStudent(id) {
    fetch(`../../../app/controllers/registrar/EnrollStudentController.php?action=get&id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.error) {
                alert('Failed to load student data.');
                return;
            }

            // Personal Information
            document.getElementById('view_lrn').textContent             = data.lrn ?? 'N/A';
            document.getElementById('view_first_name').textContent      = data.first_name ?? 'N/A';
            document.getElementById('view_middle_name').textContent     = data.middle_name ?? 'N/A';
            document.getElementById('view_last_name').textContent       = data.last_name ?? 'N/A';
            document.getElementById('view_birth_date').textContent      = data.birth_date ?? 'N/A';
            document.getElementById('view_age').textContent             = data.age ?? 'N/A';
            document.getElementById('view_place_of_birth').textContent  = data.place_of_birth ?? 'N/A';

            // Dropdowns
            document.getElementById('view_gender').textContent          = data.gender ?? 'N/A';
            document.getElementById('view_suffix').textContent          = data.suffix ?? 'N/A';

            // Background
            document.getElementById('view_nationality').textContent     = data.nationality ?? 'N/A';
            document.getElementById('view_religion').textContent        = data.religion ?? 'N/A';
            document.getElementById('view_address').textContent         = data.address ?? 'N/A';

            // Contact
            document.getElementById('view_contact_number').textContent  = data.contact_number ?? 'N/A';
            document.getElementById('view_email').textContent           = data.email ?? 'N/A';

            // Enrollment Status with badge
            const statusElement = document.getElementById('view_enrollment_status');
            const status = data.enrollment_status ?? 'N/A';
            let badgeClass = 'bg-secondary';
            if(status === 'Enrolled') badgeClass = 'bg-success';
            else if(status === 'Pending') badgeClass = 'bg-warning';
            else if(status === 'Dropped') badgeClass = 'bg-danger';
            statusElement.innerHTML = `<span class="badge ${badgeClass}">${status}</span>`;

            // Profile photo preview
            const preview = document.getElementById('view_profile_preview');
            const placeholder = document.getElementById('view_profile_placeholder');
            if (data.profile_photo) {
                preview.src         = `../../../uploads/${data.profile_photo}`;
                preview.style.display = 'inline-block';
                placeholder.style.display = 'none';
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'flex';
            }

            // Open modal
            const modal = new bootstrap.Modal(document.getElementById('viewStudentModal'));
            modal.show();
        })
        .catch(err => {
            console.error('viewStudent error:', err);
            alert('An error occurred while loading student data.');
        });
}

function editStudent(id) {
    fetch(`../../../app/controllers/registrar/EnrollStudentController.php?action=get&id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.error) {
                alert('Failed to load student data.');
                return;
            }

            // Hidden ID
            document.getElementById('edit_id').value              = data.id ?? '';

            // Personal Information
            document.getElementById('edit_lrn').value             = data.lrn ?? '';
            document.getElementById('edit_first_name').value      = data.first_name ?? '';
            document.getElementById('edit_middle_name').value     = data.middle_name ?? '';
            document.getElementById('edit_last_name').value       = data.last_name ?? '';
            document.getElementById('edit_birth_date').value      = data.birth_date ?? '';
            document.getElementById('edit_age').value             = data.age ?? '';
            document.getElementById('edit_place_of_birth').value  = data.place_of_birth ?? '';
            

            // Dropdowns
            setSelectValue('edit_gender', data.gender);
            setSelectValue('edit_suffix', data.suffix);
            setSelectValue('edit_enrollment_status', data.enrollment_status);

            // Background
            document.getElementById('edit_nationality').value     = data.nationality ?? '';
            document.getElementById('edit_religion').value        = data.religion ?? '';
            document.getElementById('edit_address').value         = data.address ?? '';
            document.getElementById('edit_grade_level').value     = data.grade_level ?? '';

            // Contact
            document.getElementById('edit_contact_number').value  = data.contact_number ?? '';
            document.getElementById('edit_email').value           = data.email ?? '';

            // Profile photo preview
            const preview = document.getElementById('edit_profile_preview');
            const label   = document.getElementById('edit_profile_name');
            if (data.profile_photo) {
                preview.src         = `../../../uploads/${data.profile_photo}`;
                preview.style.display = 'inline-block';
                label.textContent   = data.profile_photo;
            } else {
                preview.style.display = 'none';
                label.textContent     = 'No photo uploaded';
            }

            // Open modal
            const modal = new bootstrap.Modal(document.getElementById('editStudentModal'));
            modal.show();
        })
        .catch(err => {
            console.error('editStudent error:', err);
            alert('An error occurred while loading student data.');
        });
}

function deleteStudent(id) {
    if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) return;

    fetch(`../../../app/controllers/registrar/EnrollStudentController.php?action=delete&id=${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}`
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Student deleted successfully.');
                location.reload();
            } else {
                alert(data.message || 'Failed to delete student.');
            }
        })
        .catch(err => {
            console.error('deleteStudent error:', err);
            alert('An error occurred while deleting the student.');
        });
}

// Helper: safely set a <select> value
function setSelectValue(elementId, value) {
    const select = document.getElementById(elementId);
    if (!select || value === null || value === undefined) return;
    const option = [...select.options].find(o => o.value === String(value));
    if (option) select.value = option.value;
}

// ========================================
// Search Functionality
// ========================================

let searchTimeout;

/**
 * Debounce function to limit search requests
 * @param {Function} func - Function to debounce
 * @param {number} delay - Delay in milliseconds
 */
function debounce(func, delay) {
    return function (...args) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => func.apply(this, args), delay);
    };
}

/**
 * Perform student search via API
 * @param {string} keyword - Search keyword
 */
async function searchStudents(keyword) {
    const tableBody = document.querySelector('table tbody');
    const paginationContainer = document.querySelector('.card-footer');

    // Validate keyword
    if (!keyword || keyword.trim().length < 2) {
        // Reset to show all students if keyword is empty or too short
        if (keyword === '') {
            location.reload();
        }
        return;
    }

    try {
        // Disable pagination during search
        if (paginationContainer) {
            paginationContainer.style.display = 'none';
        }

        // Show loading state
        if (tableBody) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center"><span class="spinner-border spinner-border-sm me-2"></span>Searching...</td></tr>';
        }

        // Build API URL with absolute path
        const baseUrl = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/resources'));
        const apiUrl = baseUrl + '/app/api/registrar/search-students.php?q=' + encodeURIComponent(keyword.trim());

        // Fetch search results
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error(`API error: ${response.status}`);
        }

        const data = await response.json();

        if (!data.success) {
            throw new Error(data.message || 'Search failed');
        }

        // Render search results
        renderSearchResults(data.data || []);

    } catch (error) {
        console.error('Search error:', error);
        
        // Show error message
        if (tableBody) {
            tableBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error searching students. Please try again.</td></tr>';
        }
    }
}

/**
 * Render search results in the table
 * @param {Array} results - Search results from API
 */
function renderSearchResults(results) {
    const tableBody = document.querySelector('table tbody');
    const paginationContainer = document.querySelector('.card-footer');

    if (!tableBody) return;

    // Clear existing content
    tableBody.innerHTML = '';

    if (results.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No students found matching your search.</td></tr>';
        if (paginationContainer) {
            paginationContainer.style.display = 'none';
        }
        return;
    }

    const rows = results.map((student, index) => {
        const studentName = `${student.first_name || ''} ${student.middle_name || ''} ${student.last_name || ''}`.trim();
        const lrn = student.lrn || 'N/A';
        const gradeLevel = student.grade_level || 'N/A';
        const enrollmentStatus = student.enrollment_status || 'N/A';

        return `
            <tr>
                <td>${escapeHtml(index + 1)}</td>
                <td>${escapeHtml(lrn)}</td>
                <td>${escapeHtml(studentName)}</td>
                <td>${escapeHtml(gradeLevel)}</td>
                <td>${escapeHtml(enrollmentStatus)}</td>
                <td>
                    <button 
                        class="btn btn-sm btn-info me-1"
                        title="View Student"
                        onclick="viewStudent(${student.id})"
                    >
                        View
                    </button>

                    <button 
                        class="btn btn-sm btn-warning me-1"
                        title="Edit Student"
                        onclick="editStudent(${student.id})"
                    >
                        Edit
                    </button>

                    <button 
                        class="btn btn-sm btn-danger" 
                        title="Delete Student"
                        onclick="if(confirm('Are you sure you want to delete this student?')) deleteStudent(${student.id})"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        `;
    }).join('');

    // Insert rows into table
    tableBody.innerHTML = rows;

    // Hide pagination during search results
    if (paginationContainer) {
        paginationContainer.style.display = 'none';
    }
}

/**
 * Escape HTML special characters for safe display
 * @param {string} text - Text to escape
 */
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return String(text).replace(/[&<>"']/g, m => map[m]);
}

/**
 * Initialize search functionality
 */
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    
    if (!searchInput) return;

    const debouncedSearch = debounce((e) => {
        const keyword = e.target.value.trim();
        searchStudents(keyword);
    }, 300);

    searchInput.addEventListener('input', debouncedSearch);
}

document.addEventListener('DOMContentLoaded', initializeSearch);