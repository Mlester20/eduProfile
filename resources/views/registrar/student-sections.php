<?php
require_once __DIR__ . '/../../../app/controllers/registrar/StudentSectionController.php';
require_once __DIR__ . '/../../../app/helpers/message.php';
require_once __DIR__ . '/../../../app/middleware/Role.php';
require_once __DIR__ . '/../../../database/config/config.php';
AuthRole::allowOnly(['registrar']);

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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Student Sections </title>
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

    <?php showFlash(); ?>
   
    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="text-end">
        <button 
            class="btn  btn-primary"
            data-bs-toggle="modal" 
            data-bs-target="#addSubjectModal"
        >
            Add Student Section
        </button>
    </div>

    <!-- add student section modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../app/controllers/registrar/StudentSectionController.php" method="post">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student Name</label>
                            <select class="form-control" id="student_id" name="student_id" required>
                                <option value="">Select Student</option>
                                <?php foreach($students as $student): ?>
                                    <option value="<?php echo $student['id']; ?>">
                                        <?php echo $student['first_name'] . ' ' . $student['last_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="section_id" class="form-label">Section</label>
                            <select class="form-control" id="section_id" name="section_id" required>
                                <option value="">Select Section</option>
                                <?php foreach($sections as $section): ?>
                                    <option value="<?php echo $section['id']; ?>">
                                        <?php echo $section['section_info']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_student_section">Add Student Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- edit student section modal -->
    <div class="modal fade" id="editStudentSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../app/controllers/registrar/StudentSectionController.php" method="post">
                        <input type="hidden" id="edit-student-section-id" name="id">
                        <!-- return readonly to avoid duplicating student section -->
                        <div class="mb-3">
                            <label for="edit-student-id" class="form-label">Student</label>
                            <select class="form-control" id="edit-student-id" name="student_id" required>
                                <option value="">Select Student</option>
                                <?php foreach($all_students as $student): ?>
                                    <option value="<?php echo $student['id']; ?>">
                                        <?php echo $student['first_name'] . ' ' . $student['last_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-section-id" class="form-label">Section</label>
                            <select class="form-control" id="edit-section-id" name="section_id" required>
                                <option value="">Select Section</option>
                                <?php foreach($all_sections as $section): ?>
                                    <option value="<?php echo $section['id']; ?>">
                                        <?php echo $section['section_info']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_student_section">Update Student Section</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">

        <h5 class="card-header">Student Sections</h5>
        <div class="table-responsive nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Year & Section</th>
                        <th>Assigned Teacher</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($student_sections)): ?>
                        <?php foreach($student_sections as $section): ?>
                            <tr>
                                <td><?php echo $section['id']; ?></td>
                                <td><?php echo $section['student_name']; ?></td>
                                <td><?php echo $section['school_year'] . ' - ' . $section['section_name']; ?></td>
                                <td><?php echo $section['teacher_name']; ?></td>
                                    <td class="d-flex gap-1 align-items-center">
                                        <button 
                                            class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editStudentSectionModal" 
                                            onclick="editStudentSection(<?php echo $section['id']; ?>, 
                                            <?php echo $section['student_id']; ?>, 
                                            <?php echo $section['section_id']; ?>)">
                                            Edit
                                        </button>
                                        
                                        <form action="../../../app/controllers/registrar/StudentSectionController.php" method="post" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $section['id']; ?>">
                                            <button 
                                                type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                name="delete_student_section" 
                                                onclick="return confirm('Are you sure you want to delete this student section?')"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No student sections found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small class="text-muted">
                        Showing <?php echo !empty($student_sections) ? (($current_page - 1) * $items_per_page + 1) : 0; ?> 
                        to 
                        <?php echo min($current_page * $items_per_page, $total_items); ?> 
                        of <?php echo $total_items; ?> entries
                    </small>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-end mb-0">
                            <!-- Previous Button -->
                            <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo max(1, $current_page - 1); ?>">Previous</a>
                            </li>

                            <!-- Page Numbers -->
                            <?php
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($total_pages, $current_page + 2);

                            if($start_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=1">1</a>
                                </li>
                                <?php if($start_page > 2): ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif;
                            endif;

                            for($page = $start_page; $page <= $end_page; $page++): ?>
                                <li class="page-item <?php echo $page === $current_page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                </li>
                            <?php endfor;

                            if($end_page < $total_pages): ?>
                                <?php if($end_page < $total_pages - 1): ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                                </li>
                            <?php endif; ?>

                            <!-- Next Button -->
                            <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo min($total_pages, $current_page + 1); ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
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
    <script src="../../../public/js/registrar/student-section.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>