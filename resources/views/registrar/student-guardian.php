<?php
require_once __DIR__ . '/../../../app/controllers/registrar/StudentGuardianController.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../../app/helpers/message.php';
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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Parent/Guardian </title>
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

    <div class="text-end">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuardianModal">Entry Student Guardian</button>
    </div>

    <!-- add modal -->
    <div class="modal fade" id="addGuardianModal" tabindex="-1" aria-labelledby="addGuardianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addGuardianModalLabel">Add Guardian</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../../app/controllers/registrar/StudentGuardianController.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="addGuardian" value="1">
              <div class="modal-body">
                <div class="mb-3">
                  <p class="text-muted">Note : Leave Blank if Not Applicable</p>
                  <label for="studentId" class="form-label">Student</label>
                  <select class="form-control" id="studentId" name="student_id" required>
                    <option value="">-- Select Student --</option>
                    <?php if (!empty($students)) : ?>
                      <?php foreach ($students as $student) : ?>
                        <option value="<?php echo htmlspecialchars($student['id']); ?>">
                          <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-3">Father Info</h6>
                    <div class="mb-3">
                      <label for="fatherName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="fatherName" name="father_name">
                    </div>
                    <div class="mb-3">
                      <label for="fatherOccupation" class="form-label">Occupation</label>
                      <input type="text" class="form-control" id="fatherOccupation" name="father_occupation">
                    </div>
                    <div class="mb-3">
                      <label for="fatherContact" class="form-label">Contact</label>
                      <input type="tel" class="form-control" id="fatherContact" name="father_contact">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <h6 class="mb-3">Mother Info</h6>
                    <div class="mb-3">
                      <label for="motherName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="motherName" name="mother_name">
                    </div>
                    <div class="mb-3">
                      <label for="motherOccupation" class="form-label">Occupation</label>
                      <input type="text" class="form-control" id="motherOccupation" name="mother_occupation">
                    </div>
                    <div class="mb-3">
                      <label for="motherContact" class="form-label">Contact</label>
                      <input type="tel" class="form-control" id="motherContact" name="mother_contact">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-3">Guardian Info</h6>
                    <div class="mb-3">
                      <label for="guardianName" class="form-label">Name</label>
                      <input type="text" class="form-control" id="guardianName" name="guardian_name">
                    </div>
                    <div class="mb-3">
                      <label for="guardianRelationship" class="form-label">Relationship</label>
                      <input type="text" class="form-control" id="guardianRelationship" name="guardian_relationship">
                    </div>
                    <div class="mb-3">
                      <label for="guardianContact" class="form-label">Contact</label>
                      <input type="tel" class="form-control" id="guardianContact" name="guardian_contact">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <h6 class="mb-3">Financial Info</h6>
                    <div class="mb-3">
                      <label for="monthlyIncome" class="form-label">Monthly Income</label>
                      <input type="number" class="form-control" id="monthlyIncome" name="monthly_income" step="0.01">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
              </div>
            </form>
          </div>
        </div>
    </div>


    <!-- Edit Parent/Guardian Modal -->
    <div class="modal fade" id="editGuardianModal" tabindex="-1" aria-labelledby="editGuardianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGuardianModalLabel">Edit Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../../../app/controllers/registrar/StudentGuardianController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="updateGuardian" value="1">
                    <div class="modal-body">
                        <div class="mb-3">
                          <label for="editStudentId" class="form-label">Student</label>
                          <select class="form-control" id="editStudentId" name="student_id" required>
                            <option value="">-- Select Student --</option>
                            <?php if (!empty($students)) : ?>
                              <?php foreach ($students as $student) : ?>
                                <option value="<?php echo htmlspecialchars($student['id']); ?>">
                                  <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                                </option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <h6 class="mb-3">Father Info</h6>
                            <div class="mb-3">
                              <label for="editFatherName" class="form-label">Name</label>
                              <input type="text" class="form-control" id="editFatherName" name="father_name">
                            </div>
                            <div class="mb-3">
                              <label for="editFatherOccupation" class="form-label">Occupation</label>
                              <input type="text" class="form-control" id="editFatherOccupation" name="father_occupation">
                            </div>
                            <div class="mb-3">
                              <label for="editFatherContact" class="form-label">Contact</label>
                              <input type="tel" class="form-control" id="editFatherContact" name="father_contact">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <h6 class="mb-3">Mother Info</h6>
                            <div class="mb-3">
                              <label for="editMotherName" class="form-label">Name</label>
                              <input type="text" class="form-control" id="editMotherName" name="mother_name">
                            </div>
                            <div class="mb-3">
                              <label for="editMotherOccupation" class="form-label">Occupation</label>
                              <input type="text" class="form-control" id="editMotherOccupation" name="mother_occupation">
                            </div>
                            <div class="mb-3">
                              <label for="editMotherContact" class="form-label">Contact</label>
                              <input type="tel" class="form-control" id="editMotherContact" name="mother_contact">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <h6 class="mb-3">Guardian Info</h6>
                            <div class="mb-3">
                              <label for="editGuardianName" class="form-label">Name</label>
                              <input type="text" class="form-control" id="editGuardianName" name="guardian_name">
                            </div>
                            <div class="mb-3">
                              <label for="editGuardianRelationship" class="form-label">Relationship</label>
                              <input type="text" class="form-control" id="editGuardianRelationship" name="guardian_relationship">
                            </div>
                            <div class="mb-3">
                              <label for="editGuardianContact" class="form-label">Contact</label>
                              <input type="tel" class="form-control" id="editGuardianContact" name="guardian_contact">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <h6 class="mb-3">Financial Info</h6>
                            <div class="mb-3">
                              <label for="editMonthlyIncome" class="form-label">Monthly Income</label>
                              <input type="number" class="form-control" id="editMonthlyIncome" name="monthly_income" step="0.01">
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="updateGuardian">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- view modal -->
    <div class="modal fade" id="viewGuardianModal" tabindex="-1" aria-labelledby="viewGuardianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewGuardianModalLabel">View Guardian Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                      <label for="viewStudentName" class="form-label">Student</label>
                      <input type="text" class="form-control" id="viewStudentName" name="student_name" readonly>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <h6 class="mb-3">Father Info</h6>
                        <div class="mb-3">
                          <label for="viewFatherName" class="form-label">Name</label>
                          <input type="text" class="form-control" id="viewFatherName" name="father_name" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewFatherOccupation" class="form-label">Occupation</label>
                          <input type="text" class="form-control" id="viewFatherOccupation" name="father_occupation" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewFatherContact" class="form-label">Contact</label>
                          <input type="text" class="form-control" id="viewFatherContact" name="father_contact" readonly>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <h6 class="mb-3">Mother Info</h6>
                        <div class="mb-3">
                          <label for="viewMotherName" class="form-label">Name</label>
                          <input type="text" class="form-control" id="viewMotherName" name="mother_name" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewMotherOccupation" class="form-label">Occupation</label>
                          <input type="text" class="form-control" id="viewMotherOccupation" name="mother_occupation" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewMotherContact" class="form-label">Contact</label>
                          <input type="text" class="form-control" id="viewMotherContact" name="mother_contact" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <h6 class="mb-3">Guardian Info</h6>
                        <div class="mb-3">
                          <label for="viewGuardianName" class="form-label">Name</label>
                          <input type="text" class="form-control" id="viewGuardianName" name="guardian_name" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewGuardianRelationship" class="form-label">Relationship</label>
                          <input type="text" class="form-control" id="viewGuardianRelationship" name="guardian_relationship" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="viewGuardianContact" class="form-label">Contact</label>
                          <input type="text" class="form-control" id="viewGuardianContact" name="guardian_contact" readonly>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <h6 class="mb-3">Financial Info</h6>
                        <div class="mb-3">
                          <label for="viewMonthlyIncome" class="form-label">Monthly Income</label>
                          <input type="text" class="form-control" id="viewMonthlyIncome" name="monthly_income" readonly>
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

    <div class="card mt-4">
      <h5 class="card-header">Student Guardians</h5>
      <div class="table-responsive nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Guardian Name</th>
                <th>Relationship</th>
                <th>Contact Number</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($guardians)) : ?>
                <?php foreach ($guardians as $guardian) : ?>
                  <tr>
                    <td><?php echo htmlspecialchars($guardian['id']); ?></td>
                    <td><?php echo htmlspecialchars($guardian['student_first_name'] . ' ' . $guardian['student_last_name']); ?></td>
                    <td><?php echo htmlspecialchars($guardian['guardian_name']); ?></td>
                    <td><?php echo htmlspecialchars($guardian['guardian_relationship']); ?></td>
                    <td>
                      <?php echo htmlspecialchars($guardian['guardian_contact'] ?: 'N/A'); ?>
                    </td>
                    <td>
                      <button 
                        class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#viewGuardianModal"
                        onclick="viewGuardian(
                            '<?php echo addslashes($guardian['student_first_name'] . ' ' . $guardian['student_last_name']); ?>',
                            '<?php echo addslashes($guardian['father_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['father_occupation'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['father_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_occupation'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_relationship'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['monthly_income'] ?? ''); ?>'
                        )" 
                      >
                        View
                      </button>

                      <button 
                        class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editGuardianModal"
                        onclick="editGuardian(
                            <?php echo $guardian['id']; ?>,
                            '<?php echo addslashes($guardian['student_id'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['father_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['father_occupation'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['father_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_occupation'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['mother_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_name'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_relationship'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['guardian_contact'] ?? ''); ?>',
                            '<?php echo addslashes($guardian['monthly_income'] ?? ''); ?>'
                        )" 
                      >
                        Edit
                      </button>

                      <form action="../../../app/controllers/registrar/StudentGuardianController.php" method="post" style="display: inline";>
                        <input type="hidden" name="guardian_id" value="<?php echo $guardian['id']; ?>">
                        <button 
                          type="submit" 
                          name="deleteGuardian" 
                          class="btn btn-sm btn-danger" 
                          onclick="return confirm('Are you sure you want to delete this guardian?');">
                          Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="7" class="text-center">No guardians found.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
      </div>

      <!-- Pagination -->
      <div class="card-footer" style="background-color: transparent; border: none; padding: 1rem 0;">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-end mb-0">
            <?php if ($current_page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=1">First</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
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
            $totalPages = $total_pages;
            $currentPage = $current_page;
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

            <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $total_pages; ?>">Last</a>
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
        <p class="text-muted mb-0">Showing <?php echo !empty($guardians) ? (($current_page - 1) * 10) + 1 : 0; ?> to <?php echo min($current_page * 10, $total_guardians); ?> of <?php echo $total_guardians; ?> guardians</p>
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
    <script src="../../../public/js/registrar/guardians.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>