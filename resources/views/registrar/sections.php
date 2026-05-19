<?php
require_once __DIR__ . '/../../../app/controllers/registrar/SectionsController.php';
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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Dashboard </title>
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
    <script src="../../../public/assets/vendor/js/helpers.js"></script>
    <script src="../../../public/assets/js/config.js"></script>
</head>
<body>

    <?php showFlash(); ?>

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="card">
      <h5 class="card-header">Sections</h5>
      <div class="table-responsive nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Section Name</th>
              <th>Grade Level</th>
              <th>Teacher</th>
              <th>School Year</th>
              <th>Max Students</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sections as $section): ?>
              <tr>
                <td><?php echo $section['id']; ?></td>
                <td><?php echo $section['section_name']; ?></td>
                <td><?php echo $section['grade_level']; ?></td>
                <td><?php echo $section['adviser_name']; ?></td>
                <td><?php echo $section['school_year']; ?></td>
                <td><?php echo $section['max_students']; ?></td>
                <td>
                  <button class="btn btn-sm btn-primary">Edit</button>

                  <form method="POST" action="../../../app/controllers/registrar/SectionsController.php" style="display: inline;">
                    <input type="hidden" name="delete_section" value="<?php echo $section['id']; ?>">
                    <button 
                        type="submit" 
                        class="btn btn-sm btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this section?')"
                        >
                        Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
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
</body>
</html>