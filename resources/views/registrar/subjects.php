<?php
require_once __DIR__ . '/../../../app/controllers/registrar/SubjectsController.php';
require_once __DIR__ . '/../../../app/helpers/message.php';
require_once __DIR__ . '/../../../app/middleware/auth.php';
require_once __DIR__ . '/../../../database/config/config.php';
allowOnly(['registrar']);

try{
    $controller = new SubjectsController($con);
}catch(Exception $e){
    echo($e->getMessage());
}
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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Subjects </title>
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
            Add Subject
        </button>
    </div>

    <!-- add subject modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../app/controllers/registrar/SubjectsController.php" method="post">
                        <div class="mb-3">
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="e.g., Fil-101" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject_name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="e.g., Filipino" required>
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
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($subjects)): 
                    ?>
                        <?php foreach($subjects as $subject): ?>
                            <tr>
                                <td><?php echo $subject['id']; ?></td>
                                <td><?php echo $subject['subject_code']; ?></td>
                                <td><?php echo $subject['subject_name']; ?></td>
                                <td>
                                    <button 
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editSubjectModal"
                                        onclick="editSubjects(
                                            '<?php echo $subject['id']; ?>',
                                            '<?php echo $subject['subject_code']; ?>',
                                            '<?php echo $subject['subject_name']; ?>'
                                        )";
                                        >
                                        Edit
                                    </button>
                                    <form action="../../../app/controllers/registrar/SubjectsController.php" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $subject['id']; ?>">
                                        <button 
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            name="delete_subject"
                                            onclick="return confirm('Are you sure you want to delete this subject?');"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No subjects found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer" style="background-color: transparent; border: none; padding: 1rem 0;">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-3">
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
                    $maxVisible = 5;
                    $startPage = max(1, $current_page - floor($maxVisible / 2));
                    $endPage = min($total_pages, $startPage + $maxVisible - 1);
                    $startPage = max(1, $endPage - $maxVisible + 1);

                    for ($i = $startPage; $i <= $endPage; $i++):
                    ?>
                    <li class="page-item <?php echo ($i === $current_page) ? 'active' : ''; ?>">
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
            <p class="text-muted mb-0">Showing <?php echo !empty($subjects) ? (($current_page - 1) * 10) + 1 : 0; ?> to <?php echo min($current_page * 10, $total_subjects); ?> of <?php echo $total_subjects; ?> subjects</p>
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