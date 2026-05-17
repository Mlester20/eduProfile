<?php
session_start();

require_once __DIR__ . '/../../../app/middleware/auth.php';
allowOnly(['registrar']);

// Active school year — update this when SY changes
$activeSY = '2026–2027';
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

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Page Header -->
        <div class="row mb-3">
          <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
              <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Registrar /</span> Dashboard
              </h4>
              <p class="text-muted mb-0">
                Welcome back! Here's the enrollment overview for S.Y. <strong><?= $activeSY ?></strong>.
              </p>
            </div>
            <!-- Active SY Badge -->
            <div class="d-flex align-items-center gap-2">
              <span class="text-muted small">Active School Year:</span>
              <span class="badge bg-primary fs-6 px-3 py-2">
                <i class="bx bx-calendar me-1"></i> S.Y. <?= $activeSY ?>
              </span>
            </div>
          </div>
        </div>

        <!-- ===================== ROW 1: KEY STAT CARDS ===================== -->
        <div class="row mb-4">

          <!-- Total Students -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-primary">
                      <i class="bx bxs-graduation fs-4"></i>
                    </span>
                  </div>
                  <span class="badge bg-label-primary rounded-pill">S.Y. <?= $activeSY ?></span>
                </div>
                <span class="d-block mb-1 text-muted">Total Students</span>
                <h3 class="card-title mb-1">248</h3>
                <small class="text-success fw-semibold">
                  <i class="bx bx-up-arrow-alt"></i> +12 new enrollees
                </small>
              </div>
            </div>
          </div>

          <!-- Enrolled -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-success">
                      <i class="bx bxs-user-check fs-4"></i>
                    </span>
                  </div>
                  <span class="badge bg-label-success rounded-pill">Active</span>
                </div>
                <span class="d-block mb-1 text-muted">Enrolled</span>
                <h3 class="card-title mb-1">235</h3>
                <small class="text-muted fw-semibold">S.Y. <?= $activeSY ?></small>
              </div>
            </div>
          </div>

          <!-- Not Yet Enrolled -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-warning">
                      <i class="bx bx-user-x fs-4"></i>
                    </span>
                  </div>
                  <span class="badge bg-label-warning rounded-pill">Pending</span>
                </div>
                <span class="d-block mb-1 text-muted">Not Yet Enrolled</span>
                <h3 class="card-title mb-1">13</h3>
                <small class="text-warning fw-semibold">
                  <i class="bx bx-error-circle"></i> For follow-up
                </small>
              </div>
            </div>
          </div>

          <!-- Documents Uploaded -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-info">
                      <i class="bx bxs-file-archive fs-4"></i>
                    </span>
                  </div>
                  <span class="badge bg-label-info rounded-pill">Files</span>
                </div>
                <span class="d-block mb-1 text-muted">Documents Uploaded</span>
                <h3 class="card-title mb-1">512</h3>
                <small class="text-success fw-semibold">
                  <i class="bx bx-up-arrow-alt"></i> +8 this week
                </small>
              </div>
            </div>
          </div>

        </div>
        <!-- ===================== END ROW 1 ===================== -->


        <!-- ===================== ROW 2: DETAILS ===================== -->
        <div class="row">

          <!-- Enrollment by Grade Level -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div>
                  <h5 class="card-title m-0">Enrollment by Grade</h5>
                  <small class="text-muted">S.Y. <?= $activeSY ?></small>
                </div>
                <span class="badge bg-label-primary rounded-pill">248 Total</span>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <?php
                  $grades = [
                    ['level' => 'Grade 1', 'count' => 42, 'color' => 'primary'],
                    ['level' => 'Grade 2', 'count' => 38, 'color' => 'success'],
                    ['level' => 'Grade 3', 'count' => 40, 'color' => 'info'],
                    ['level' => 'Grade 4', 'count' => 37, 'color' => 'warning'],
                    ['level' => 'Grade 5', 'count' => 41, 'color' => 'danger'],
                    ['level' => 'Grade 6', 'count' => 50, 'color' => 'secondary'],
                  ];
                  foreach ($grades as $index => $grade):
                    $isLast = $index === count($grades) - 1;
                    $pct    = round($grade['count'] / 248 * 100);
                  ?>
                  <li class="d-flex <?= $isLast ? '' : 'mb-3 pb-1' ?>">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2" style="min-width: 70px;">
                        <h6 class="mb-0"><?= $grade['level'] ?></h6>
                      </div>
                      <div class="d-flex align-items-center gap-2 flex-grow-1">
                        <div class="progress flex-grow-1" style="height: 6px;">
                          <div class="progress-bar bg-<?= $grade['color'] ?>" style="width: <?= $pct ?>%"></div>
                        </div>
                        <span class="fw-semibold text-muted" style="min-width: 28px;"><?= $grade['count'] ?></span>
                      </div>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- Recent Enrollments -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h5 class="card-title m-0">Recent Enrollments</h5>
                <small class="text-muted">Latest student records added</small>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <?php
                  $recent = [
                    ['name' => 'Maria Santos',      'grade' => 'Grade 1', 'date' => 'May 15, 2025', 'color' => 'success'],
                    ['name' => 'Juan dela Cruz',    'grade' => 'Grade 3', 'date' => 'May 14, 2025', 'color' => 'primary'],
                    ['name' => 'Ana Reyes',         'grade' => 'Grade 2', 'date' => 'May 13, 2025', 'color' => 'info'],
                    ['name' => 'Carlo Villanueva',  'grade' => 'Grade 5', 'date' => 'May 12, 2025', 'color' => 'warning'],
                    ['name' => 'Liza Gomez',        'grade' => 'Grade 6', 'date' => 'May 11, 2025', 'color' => 'danger'],
                  ];
                  foreach ($recent as $index => $student):
                    $isLast = $index === count($recent) - 1;
                  ?>
                  <li class="d-flex <?= $isLast ? '' : 'mb-3 pb-1' ?>">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded-circle bg-label-<?= $student['color'] ?>">
                        <?= strtoupper(substr($student['name'], 0, 1)) ?>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div>
                        <h6 class="mb-0"><?= htmlspecialchars($student['name']) ?></h6>
                        <small class="text-muted"><?= $student['grade'] ?></small>
                      </div>
                      <small class="text-muted"><?= $student['date'] ?></small>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="col-md-12 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h5 class="card-title m-0">Quick Actions</h5>
                <small class="text-muted">Registrar shortcuts</small>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2">

                  <a href="/registrar/students/enroll" class="btn btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bx bx-user-plus"></i>
                    <span>Enroll New Student</span>
                  </a>

                  <a href="/registrar/students" class="btn btn-outline-success d-flex align-items-center gap-2">
                    <i class="bx bx-list-ul"></i>
                    <span>View All Students</span>
                  </a>

                  <a href="/registrar/health-records" class="btn btn-outline-danger d-flex align-items-center gap-2">
                    <i class="bx bxs-heart"></i>
                    <span>Health Records</span>
                  </a>

                  <a href="/registrar/documents/upload" class="btn btn-outline-info d-flex align-items-center gap-2">
                    <i class="bx bx-upload"></i>
                    <span>Upload Documents</span>
                  </a>

                  <a href="/registrar/documents" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                    <i class="bx bx-folder-open"></i>
                    <span>Manage Documents</span>
                  </a>

                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- ===================== END ROW 2 ===================== -->

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