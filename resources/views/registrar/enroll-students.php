<?php
require_once __DIR__ . '/../../../app/helpers/message.php';
require_once __DIR__ . '/../../../app/controllers/registrar/EnrollStudentController.php';
require_once __DIR__ . '/../../../app/middleware/auth.php';
allowOnly(['registrar']);
?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../../public/assets/"
  data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Home </title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../../../public/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../../public/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../../../public/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../../public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../../public/assets/css/demo.css" />
    <link rel="stylesheet" href="../../../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../../public/assets/vendor/libs/apex-charts/apex-charts.css" />
    <script src="../../../public/assets/vendor/js/helpers.js"></script>
    <script src="../../../public/assets/js/config.js"></script>
  </head>
<body>

    <?php showFlash(); ?>

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <!-- button to triggered enroll student modal -->
    <div class="text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enrollStudentModal">
            Enroll Student
        </button>
    </div>

    <!-- Enroll Student Modal -->
    <div class="modal fade" id="enrollStudentModal" tabindex="-1" aria-labelledby="enrollStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollStudentModalLabel">Enroll New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../../../app/controllers/registrar/EnrollStudentController.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <!-- Section: Personal Information -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Personal Information</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">LRN</label>
                                <input type="text" name="lrn" class="form-control form-control-sm" placeholder="Learner Reference Number" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label form-label-sm">Gender</label>
                                <select name="gender" class="form-select form-select-sm" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label form-label-sm">Suffix</label>
                                <select name="suffix" class="form-select form-select-sm">
                                    <option value="">None</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form-label-sm">First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-sm" placeholder="First name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control form-control-sm" placeholder="Middle name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Last name" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Birth Date</label>
                                <input type="date" name="birth_date" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label form-label-sm">Age</label>
                                <input type="number" name="age" class="form-control form-control-sm" placeholder="Age" min="1" max="99">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Place of Birth</label>
                                <input type="text" name="place_of_birth" class="form-control form-control-sm" placeholder="City / Municipality">
                            </div>
                        </div>

                        <!-- Section: Background -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Background</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Nationality</label>
                                <input type="text" name="nationality" class="form-control form-control-sm" placeholder="e.g. Filipino" value="Filipino">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Religion</label>
                                <input type="text" name="religion" class="form-control form-control-sm" placeholder="e.g. Roman Catholic">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label form-label-sm">Address</label>
                                <input type="text" name="address" class="form-control form-control-sm" placeholder="Complete address">
                            </div>
                        </div>

                        <!-- Section: Contact & Account -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Contact & Account</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control form-control-sm" placeholder="09XXXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="email@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Enrollment Status</label>
                                <select name="enrollment_status" class="form-select form-select-sm" required>
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Enrolled">Enrolled</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Dropped">Dropped</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Profile Photo</label>
                                <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="enrollStudent">Enroll Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Student Modal -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStudentModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-3 text-center">
                            <img id="view_profile_preview" src="" alt="Profile Photo"
                                class="rounded" style="height: 120px; width: 120px; object-fit: cover; display: none;">
                            <div id="view_profile_placeholder" class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 120px; width: 120px; display: none;">
                                <span class="text-muted">No Photo</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <!-- Personal Information -->
                            <p class="text-muted fw-semibold small text-uppercase mb-2">Personal Information</p>
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <small class="text-muted">LRN</small>
                                    <p id="view_lrn" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Gender</small>
                                    <p id="view_gender" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Suffix</small>
                                    <p id="view_suffix" class="mb-0">N/A</p>
                                </div>

                                <div class="col-md-4">
                                    <small class="text-muted">First Name</small>
                                    <p id="view_first_name" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Middle Name</small>
                                    <p id="view_middle_name" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted">Last Name</small>
                                    <p id="view_last_name" class="mb-0">N/A</p>
                                </div>

                                <div class="col-md-4">
                                    <small class="text-muted">Birth Date</small>
                                    <p id="view_birth_date" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-2">
                                    <small class="text-muted">Age</small>
                                    <p id="view_age" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Place of Birth</small>
                                    <p id="view_place_of_birth" class="mb-0">N/A</p>
                                </div>
                            </div>

                            <!-- Background -->
                            <p class="text-muted fw-semibold small text-uppercase mb-2">Background</p>
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <small class="text-muted">Nationality</small>
                                    <p id="view_nationality" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Religion</small>
                                    <p id="view_religion" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-12">
                                    <small class="text-muted">Address</small>
                                    <p id="view_address" class="mb-0">N/A</p>
                                </div>
                            </div>

                            <!-- Contact & Account -->
                            <p class="text-muted fw-semibold small text-uppercase mb-2">Contact & Account</p>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <small class="text-muted">Contact Number</small>
                                    <p id="view_contact_number" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Email</small>
                                    <p id="view_email" class="mb-0">N/A</p>
                                </div>
                                <div class="col-md-12">
                                    <small class="text-muted">Enrollment Status</small>
                                    <p id="view_enrollment_status" class="mb-0"><span class="badge bg-primary">N/A</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../../../app/controllers/registrar/EnrollStudentController.php?action=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="updateStudent" value="1">
                    <div class="modal-body">

                        <!-- Section: Personal Information -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Personal Information</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">LRN</label>
                                <input type="text" name="lrn" id="edit_lrn" class="form-control form-control-sm" placeholder="Learner Reference Number" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label form-label-sm">Gender</label>
                                <select name="gender" id="edit_gender" class="form-select form-select-sm" required>
                                    <option value="" disabled>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label form-label-sm">Suffix</label>
                                <select name="suffix" id="edit_suffix" class="form-select form-select-sm">
                                    <option value="">None</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form-label-sm">First Name</label>
                                <input type="text" name="first_name" id="edit_first_name" class="form-control form-control-sm" placeholder="First name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Middle Name</label>
                                <input type="text" name="middle_name" id="edit_middle_name" class="form-control form-control-sm" placeholder="Middle name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Last Name</label>
                                <input type="text" name="last_name" id="edit_last_name" class="form-control form-control-sm" placeholder="Last name" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form-label-sm">Birth Date</label>
                                <input type="date" name="birth_date" id="edit_birth_date" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label form-label-sm">Age</label>
                                <input type="number" name="age" id="edit_age" class="form-control form-control-sm" placeholder="Age" min="1" max="99">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Place of Birth</label>
                                <input type="text" name="place_of_birth" id="edit_place_of_birth" class="form-control form-control-sm" placeholder="City / Municipality">
                            </div>
                        </div>

                        <!-- Section: Background -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Background</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Nationality</label>
                                <input type="text" name="nationality" id="edit_nationality" class="form-control form-control-sm" placeholder="e.g. Filipino">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Religion</label>
                                <input type="text" name="religion" id="edit_religion" class="form-control form-control-sm" placeholder="e.g. Roman Catholic">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label form-label-sm">Address</label>
                                <input type="text" name="address" id="edit_address" class="form-control form-control-sm" placeholder="Complete address">
                            </div>
                        </div>

                        <!-- Section: Contact & Account -->
                        <p class="text-muted fw-semibold small text-uppercase mb-2">Contact & Account</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Contact Number</label>
                                <input type="text" name="contact_number" id="edit_contact_number" class="form-control form-control-sm" placeholder="09XXXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control form-control-sm" placeholder="email@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Enrollment Status</label>
                                <select name="enrollment_status" id="edit_enrollment_status" class="form-select form-select-sm" required>
                                    <option value="" disabled>Select status</option>
                                    <option value="Enrolled">Enrolled</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Dropped">Dropped</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label form-label-sm">Profile Photo</label>
                                <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                                <div class="mt-1">
                                    <img id="edit_profile_preview" src="" alt="Current Photo"
                                        class="rounded" style="height: 40px; width: 40px; object-fit: cover; display: none;">
                                    <small id="edit_profile_name" class="text-muted ms-1"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    
    <div class="card mt-4">
        <h5 class="card-header">Enrolled Students</h5>
        <div class="table-responsive nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>LRN</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Birth Date</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($paginatedData['students'])) {
                        $startNumber = (($paginatedData['currentPage'] - 1) * $paginatedData['perPage']) + 1;
                        foreach ($paginatedData['students'] as $index => $student) {
                            $rowNumber = $startNumber + $index;
                    ?>
                    <tr>
                        <td><?php echo $rowNumber; ?></td>
                        <td><?php echo htmlspecialchars($student['lrn'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($student['full_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($student['gender'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($student['birth_date'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($student['age'] ?? 'N/A'); ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewStudent(<?php echo $student['id']; ?>)">View</button>
                            <button class="btn btn-sm btn-primary" onclick="editStudent(<?php echo $student['id']; ?>)">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteStudent(<?php echo $student['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center">No students enrolled yet.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end mb-0">
                    <?php if ($paginatedData['currentPage'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1">First</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $paginatedData['currentPage'] - 1; ?>">Previous</a>
                    </li>
                    <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">First</span>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <?php endif; ?>

                    <!-- Page numbers -->
                    <?php
                    $totalPages = $paginatedData['totalPages'];
                    $currentPage = $paginatedData['currentPage'];
                    $maxVisible = 5;
                    $startPage = max(1, $currentPage - floor($maxVisible / 2));
                    $endPage = min($totalPages, $startPage + $maxVisible - 1);
                    $startPage = max(1, $endPage - $maxVisible + 1);

                    for ($i = $startPage; $i <= $endPage; $i++):
                    ?>
                    <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php if ($paginatedData['currentPage'] < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $paginatedData['currentPage'] + 1; ?>">Next</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $totalPages; ?>">Last</a>
                    </li>
                    <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">Last</span>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <p class="text-muted mb-0">Showing <?php echo !empty($paginatedData['students']) ? (($paginatedData['currentPage'] - 1) * $paginatedData['perPage']) + 1 : 0; ?> to <?php echo min($paginatedData['currentPage'] * $paginatedData['perPage'], $paginatedData['total']); ?> of <?php echo $paginatedData['total']; ?> students</p>
        </div>
    </div>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>
    

    <script src="../../../public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../public/assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../public/assets/vendor/js/bootstrap.js"></script>
    <script src="../../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../public/assets/vendor/js/menu.js"></script>
    <script src="../../../public/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../../public/assets/js/main.js"></script>
    <script src="../../../public/assets/js/dashboards-analytics.js"></script>
    <script src="../../../public/js/registrar/students.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>