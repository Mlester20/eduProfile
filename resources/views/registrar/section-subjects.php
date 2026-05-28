<?php
require_once __DIR__ . '/../../../app/controllers/registrar/SectionSubjectController.php';
require_once __DIR__ . '/../../../app/helpers/message.php';
require_once __DIR__ . '/../../../app/middleware/Role.php';
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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Sections </title>
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
    <script src="../../../public/assets/vendor/js/helpers.js"></script>
    <script src="../../../public/assets/js/config.js"></script>
</head>
<body>

    <?php showFlash(); ?>

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

   <div class="card">
    <h5 class="card-header">Section Subjects</h5>
    <div class="table-responsive nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Year</th>
            <th>Section</th>
            <th>Subject</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($sectionSubjects)): ?>
            <?php foreach($sectionSubjects as $sectionSubject): ?>
              <tr>
                <td><?php echo htmlspecialchars($sectionSubject['id']); ?></td>
                <td><?php echo htmlspecialchars($sectionSubject['school_year']); ?></td>
                <!-- concatenate grade level and section name -->
                <td><?php echo htmlspecialchars($sectionSubject['grade_level'] . ' - ' . $sectionSubject['section_name']); ?></td>
                <td><?php echo htmlspecialchars($sectionSubject['subject_name']); ?></td>
                <td>
                  <button class="btn btn-sm btn-primary" onclick="editSectionSubject(<?php echo $sectionSubject['id']; ?>)" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteSectionSubject(<?php echo $sectionSubject['id']; ?>)">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">No section subjects found.</td>
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
    <script src="../../../public/assets/js/main.js"></script>
    <script src="../../../public/js/registrar/section-subject.js"></script>
</body>
</html>