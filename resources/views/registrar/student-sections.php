<?php
require_once __DIR__ . '/../../../app/controllers/registrar/StudentSectionController.php';
require_once __DIR__ . '/../../../app/helpers/message.php';
require_once __DIR__ . '/../../../app/middleware/Role.php';
require_once __DIR__ . '/../../../database/config/config.php';
AuthRole::allowOnly(['registrar']);

// debugging output
echo "<pre>";
print_r($sections);
echo "</pre>";
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
        <button 
            class="btn  btn-primary"
            data-bs-toggle="modal" 
            data-bs-target="#addSubjectModal"
        >
            Add Student Section
        </button>
    </div>

    <!-- add subject modal -->
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
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="e.g., Fil-101" required>
                        </div>
                        <div class="mb-3">
                            <label for="grade_level" class="form-label">Grade Level</label>
                            <input type="text" class="form-control" id="grade_level" name="grade_level" placeholder="e.g., 10" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_subject">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- edit subject modal -->
    <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../app/controllers/registrar/SubjectsController.php" method="post">
                        <input type="hidden" id="edit_subject_id" name="id">
                        <div class="mb-3">
                            <label for="edit_subject_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="edit_subject_code" name="subject_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_grade_level" class="form-label">Grade Level</label>
                            <input type="text" class="form-control" id="edit_grade_level" name="grade_level" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_subject_name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="edit_subject_name" name="subject_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_subject">Update Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">

        <h5 class="card-header">Subjects</h5>
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
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSubjectModal" onclick="editSubject(<?php echo $section['id']; ?>)">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSubject(<?php echo $section['id']; ?>)">Delete</button>
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
    <script src="../../../public/js/registrar/subjects.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>