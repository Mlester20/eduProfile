/**
 * Handle student view modal functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    // Get all view student buttons
    const viewButtons = document.querySelectorAll('.view-student-btn');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const studentId = this.getAttribute('data-student-id');
            fetchStudentDetails(studentId);
        });
    });
});

/**
 * Fetch student details from API endpoint
 * @param {number} studentId - The ID of the student
 */
function fetchStudentDetails(studentId) {
    const apiUrl = '../../../app/api/teacher/get-student-details.php?student_id=' + studentId;
    
    fetch(apiUrl)
        .then(response => {
            // First, get the response text to see what was actually returned
            return response.text().then(text => {
                // Try to parse as JSON
                try {
                    const data = JSON.parse(text);
                    if (!response.ok) {
                        throw new Error(data.message || 'Network response was not ok');
                    }
                    return data;
                } catch (e) {
                    // If JSON parsing fails, log the actual response for debugging
                    console.error('Response text:', text);
                    throw new Error('Invalid response from server: ' + text.substring(0, 100));
                }
            });
        })
        .then(data => {
            if (data.success) {
                populateStudentModal(data.student, data.guardian);
            } else {
                alert('Error: ' + (data.message || 'Unable to load student details'));
            }
        })
        .catch(error => {
            console.error('Error fetching student details:', error);
            alert('Error loading student details: ' + error.message);
        });
}

/**
 * Populate the modal with student and guardian information
 * @param {object} student - Student data object
 * @param {object} guardian - Guardian data object or null
 */
function populateStudentModal(student, guardian) {
    document.getElementById('studentFullName').textContent = student.full_name || '-';
    document.getElementById('studentLRN').textContent = student.lrn || '-';
    document.getElementById('studentGender').textContent = student.gender || '-';
    document.getElementById('studentBirthDate').textContent = student.birth_date || '-';
    document.getElementById('studentAge').textContent = student.age || '-';
    document.getElementById('studentContactNumber').textContent = student.contact_number || '-';
    document.getElementById('studentEmail').textContent = student.email || '-';
    document.getElementById('studentAddress').textContent = student.address || '-';
    document.getElementById('studentPlaceOfBirth').textContent = student.place_of_birth || '-';
    document.getElementById('studentNationality').textContent = student.nationality || '-';
    document.getElementById('studentReligion').textContent = student.religion || '-';
    document.getElementById('studentEnrollmentStatus').textContent = student.enrollment_status || '-';

    const guardianInfoDiv = document.getElementById('guardianInfo');
    const hasGuardian = guardian && (guardian.father_name || guardian.mother_name || guardian.guardian_name);

    if (!hasGuardian) {
        guardianInfoDiv.innerHTML = `
            <div class="alert alert-warning d-flex align-items-center gap-2 mb-0" role="alert">
                <i class="bx bx-info-circle fs-5"></i>
                <span>No guardian information has been provided for this student yet.</span>
            </div>`;
        return;
    }

    let guardianHTML = '<div class="row">';

    if (guardian.father_name) {
        guardianHTML += `
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Father Name:</label>
                    <p>${guardian.father_name || '-'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Father Occupation:</label>
                    <p>${guardian.father_occupation || '-'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Father Contact:</label>
                    <p>${guardian.father_contact || '-'}</p>
                </div>
            </div>`;
    }

    if (guardian.mother_name) {
        guardianHTML += `
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Mother Name:</label>
                    <p>${guardian.mother_name || '-'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mother Occupation:</label>
                    <p>${guardian.mother_occupation || '-'}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mother Contact:</label>
                    <p>${guardian.mother_contact || '-'}</p>
                </div>
            </div>`;
    }

    guardianHTML += '</div>';

    if (guardian.guardian_name) {
        guardianHTML += `
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Guardian Name:</label>
                        <p>${guardian.guardian_name || '-'}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Guardian Relationship:</label>
                        <p>${guardian.guardian_relationship || '-'}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Guardian Contact:</label>
                        <p>${guardian.guardian_contact || '-'}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Monthly Income:</label>
                        <p>${guardian.monthly_income ? '₱' + parseFloat(guardian.monthly_income).toFixed(2) : '-'}</p>
                    </div>
                </div>
            </div>`;
    }

    guardianInfoDiv.innerHTML = guardianHTML;
}