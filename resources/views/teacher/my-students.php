<?php
session_start();
require_once __DIR__ . '/../../../app/controllers/teacher/StudentsListController.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../../app/middleware/Role.php';
AuthRole::allowOnly(['teacher']);
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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | My Students </title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../../../public/assets/img/favicon/logo.png" />
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
   
    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="row mb-3 align-items-center">
      <div class="col-md-6">
        <div class="input-group">
          <input
            type="text"
            id="searchInput" 
            class="form-control" 
            placeholder="Search students..." 
          />
        </div>
      </div>
    </div>

    <div class="card">
      <h5 class="card-header">My Students</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead> 
            <tr>
              <th>#</th>
              <th>Student Name</th>
              <th>Year & Section</th>
              <th>School Year</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="searchTable">
            <?php if(!empty($paginatedData['students'])): ?>
              <?php 
              $startNumber = (($paginatedData['currentPage'] - 1) * $paginatedData['perPage']) + 1;
              foreach($paginatedData['students'] as $index => $student): 
                $rowNumber = $startNumber + $index;
              ?>
                <tr>
                  <td><?php echo $rowNumber; ?></td>
                  <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                  <td><?php echo htmlspecialchars($student['section_grade_level'] . ' - ' . $student['section_name']); ?></td>
                  <td><?php echo htmlspecialchars($student['school_year']); ?></td>
                  <td>
                    <button class="btn btn-sm btn-primary view-student-btn" data-student-id="<?php echo $student['id']; ?>" data-bs-toggle="modal" data-bs-target="#viewStudentModal">View</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">No students found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="card-footer">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center mb-0">
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

    <!-- modal for view student information -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Student Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-3">Student Details</h6>
                <div class="mb-3">
                  <label class="form-label fw-bold">Full Name:</label>
                  <p id="studentFullName">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">LRN:</label>
                  <p id="studentLRN">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Gender:</label>
                  <p id="studentGender">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Birth Date:</label>
                  <p id="studentBirthDate">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Age:</label>
                  <p id="studentAge">-</p>
                </div>
              </div>
              <div class="col-md-6">
                <h6 class="mb-3">Contact Information</h6>
                <div class="mb-3">
                  <label class="form-label fw-bold">Contact Number:</label>
                  <p id="studentContactNumber">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Email:</label>
                  <p id="studentEmail">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Address:</label>
                  <p id="studentAddress">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Place of Birth:</label>
                  <p id="studentPlaceOfBirth">-</p>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-bold">Nationality:</label>
                  <p id="studentNationality">-</p>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <h6 class="mb-3">Personal Information</h6>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Religion:</label>
                  <p id="studentReligion">-</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Enrollment Status:</label>
                  <p id="studentEnrollmentStatus">-</p>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <h6 class="mb-3">Guardian Information</h6>
            <div id="guardianInfo">
              <p class="text-muted">Loading guardian information...</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../../../public/js/teacher/search-student.js"></script>
    <script src="../../../public/js/teacher/view-student-modal.js"></script>
</body>
</html>