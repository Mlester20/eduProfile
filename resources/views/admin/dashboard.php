<?php
session_start();

require_once __DIR__ . '/../../../app/middleware/Role.php';
AuthRole::allowOnly(['admin']);
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
    <link rel="stylesheet" href="../../../public/assets/vendor/libs/apex-charts/apex-charts.css" />
    <script src="../../../public/assets/vendor/js/helpers.js"></script>
    <script src="../../../public/assets/js/config.js"></script>
  </head>
<body>

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Page Header -->
        <div class="row mb-2">
          <div class="col-12">
            <h4 class="fw-bold py-3 mb-0">
              <span class="text-muted fw-light">Admin /</span> Dashboard
            </h4>
            <p class="text-muted mb-0">Welcome back! Here's an overview of EduProfile.</p>
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
                </div>
                <span class="d-block mb-1 text-muted">Total Students</span>
                <h3 class="card-title mb-1">248</h3>
                <small class="text-success fw-semibold">
                  <i class="bx bx-up-arrow-alt"></i> +12 this month
                </small>
              </div>
            </div>
          </div>

          <!-- Enrolled Students -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-success">
                      <i class="bx bxs-user-check fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Enrolled Students</span>
                <h3 class="card-title mb-1">235</h3>
                <small class="text-muted fw-semibold">
                  S.Y. 2024–2025
                </small>
              </div>
            </div>
          </div>

          <!-- System Users -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-warning">
                      <i class="bx bxs-group fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">System Users</span>
                <h3 class="card-title mb-1">14</h3>
                <small class="text-muted fw-semibold">
                  Admin, Registrar, Teacher
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


        <!-- ===================== ROW 2: SECONDARY STAT CARDS ===================== -->
        <div class="row mb-4">

          <!-- Today's Attendance -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-success">
                      <i class="bx bx-calendar-check fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Present Today</span>
                <h3 class="card-title mb-1">210</h3>
                <small class="text-muted fw-semibold">
                  Out of 235 enrolled
                </small>
              </div>
            </div>
          </div>

          <!-- Absent Today -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-danger">
                      <i class="bx bx-calendar-x fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Absent Today</span>
                <h3 class="card-title mb-1">25</h3>
                <small class="text-danger fw-semibold">
                  <i class="bx bx-error-circle"></i> Needs follow-up
                </small>
              </div>
            </div>
          </div>

          <!-- Academic Records -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-primary">
                      <i class="bx bxs-book-open fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Academic Records</span>
                <h3 class="card-title mb-1">235</h3>
                <small class="text-muted fw-semibold">
                  S.Y. 2024–2025
                </small>
              </div>
            </div>
          </div>

          <!-- Health Records -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-danger">
                      <i class="bx bxs-heart fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Health Records</span>
                <h3 class="card-title mb-1">248</h3>
                <small class="text-muted fw-semibold">
                  All students covered
                </small>
              </div>
            </div>
          </div>

        </div>
        <!-- ===================== END ROW 2 ===================== -->


        <!-- ===================== ROW 3: USERS & QUICK OVERVIEW ===================== -->
        <div class="row">

          <!-- System Users by Role -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Users by Role</h5>
                  <small class="text-muted">14 total accounts</small>
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">

                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-shield"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Admin</h6>
                        <small class="text-muted">Full system access</small>
                      </div>
                      <span class="badge bg-label-danger rounded-pill">1</span>
                    </div>
                  </li>

                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-id-card"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Registrar</h6>
                        <small class="text-muted">Enrollment & records</small>
                      </div>
                      <span class="badge bg-label-primary rounded-pill">2</span>
                    </div>
                  </li>

                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-success"><i class="bx bx-chalkboard"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Teacher</h6>
                        <small class="text-muted">Attendance & grades</small>
                      </div>
                      <span class="badge bg-label-success rounded-pill">10</span>
                    </div>
                  </li>

                  <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-briefcase"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Principal</h6>
                        <small class="text-muted">Reports & analytics</small>
                      </div>
                      <span class="badge bg-label-warning rounded-pill">1</span>
                    </div>
                  </li>

                </ul>
              </div>
            </div>
          </div>

          <!-- Students by Grade Level -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Students by Grade</h5>
                  <small class="text-muted">S.Y. 2024–2025</small>
                </div>
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
                    ['level' => 'Grade 6', 'count' => 37, 'color' => 'secondary'],
                  ];
                  foreach ($grades as $index => $grade):
                    $isLast = $index === count($grades) - 1;
                  ?>
                  <li class="d-flex <?= $isLast ? '' : 'mb-3 pb-1' ?>">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0"><?= $grade['level'] ?></h6>
                      </div>
                      <div class="d-flex align-items-center gap-2">
                        <div class="progress" style="width: 100px; height: 6px;">
                          <div class="progress-bar bg-<?= $grade['color'] ?>" style="width: <?= round($grade['count'] / 248 * 100) ?>%"></div>
                        </div>
                        <span class="fw-semibold text-muted" style="min-width:28px"><?= $grade['count'] ?></span>
                      </div>
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
                <div class="card-title mb-0">
                  <h5 class="m-0">Quick Actions</h5>
                  <small class="text-muted">Admin shortcuts</small>
                </div>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2">

                  <a href="/admin/users" class="btn btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bx bx-user-plus"></i>
                    <span>Manage Users</span>
                  </a>

                  <a href="/admin/students" class="btn btn-outline-success d-flex align-items-center gap-2">
                    <i class="bx bx-list-ul"></i>
                    <span>View All Students</span>
                  </a>

                  <a href="/admin/attendance" class="btn btn-outline-info d-flex align-items-center gap-2">
                    <i class="bx bx-calendar"></i>
                    <span>Attendance Records</span>
                  </a>

                  <a href="/admin/reports" class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bx bx-bar-chart-alt-2"></i>
                    <span>Generate Reports</span>
                  </a>

                  <a href="/admin/documents" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                    <i class="bx bx-folder-open"></i>
                    <span>Student Documents</span>
                  </a>

                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- ===================== END ROW 3 ===================== -->

      </div>
    </div>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>

    <script src="../../../public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../public/assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../public/assets/vendor/js/bootstrap.js"></script>
    <script src="../../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../public/assets/vendor/js/menu.js"></script>
    <script src="../../../public/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>