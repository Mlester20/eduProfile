<?php
session_start();

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
    <title> <?php require_once __DIR__ . '/../../../app/helpers/title.php'; ?> | Home </title>
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

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Page Header -->
        <div class="row mb-2">
          <div class="col-12">
            <h4 class="fw-bold py-3 mb-0">
              <span class="text-muted fw-light">Teacher /</span> Dashboard
            </h4>
            <p class="text-muted mb-0">
              Welcome back! Here's your class overview for
              <strong><?= date('F d, Y') ?></strong>.
            </p>
          </div>
        </div>

        <!-- ===================== ROW 1: KEY STAT CARDS ===================== -->
        <div class="row mb-4">

          <!-- My Students -->
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
                <span class="d-block mb-1 text-muted">My Students</span>
                <h3 class="card-title mb-1">42</h3>
                <small class="text-muted fw-semibold">Grade 4 — Section A</small>
              </div>
            </div>
          </div>

          <!-- Present Today -->
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
                <h3 class="card-title mb-1">38</h3>
                <small class="text-success fw-semibold">
                  <i class="bx bx-up-arrow-alt"></i> 90.5% attendance rate
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
                <h3 class="card-title mb-1">4</h3>
                <small class="text-danger fw-semibold">
                  <i class="bx bx-error-circle"></i> Needs follow-up
                </small>
              </div>
            </div>
          </div>

          <!-- Academic Records Encoded -->
          <div class="col-6 col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <span class="avatar-initial rounded bg-label-info">
                      <i class="bx bxs-book-open fs-4"></i>
                    </span>
                  </div>
                </div>
                <span class="d-block mb-1 text-muted">Grades Encoded</span>
                <h3 class="card-title mb-1">42</h3>
                <small class="text-muted fw-semibold">S.Y. 2024–2025</small>
              </div>
            </div>
          </div>

        </div>
        <!-- ===================== END ROW 1 ===================== -->


        <!-- ===================== ROW 2: DETAILS ===================== -->
        <div class="row">

          <!-- Attendance Summary -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h5 class="card-title m-0">Attendance Summary</h5>
                <small class="text-muted">This week — Grade 4 Section A</small>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">

                  <?php
                  $days = [
                    ['day' => 'Monday',    'present' => 40, 'absent' => 2,  'late' => 0],
                    ['day' => 'Tuesday',   'present' => 39, 'absent' => 2,  'late' => 1],
                    ['day' => 'Wednesday', 'present' => 41, 'absent' => 1,  'late' => 0],
                    ['day' => 'Thursday',  'present' => 38, 'absent' => 3,  'late' => 1],
                    ['day' => 'Friday',    'present' => 38, 'absent' => 4,  'late' => 0],
                  ];
                  foreach ($days as $index => $d):
                    $isLast = $index === count($days) - 1;
                    $rate   = round($d['present'] / 42 * 100);
                    $color  = $rate >= 90 ? 'success' : ($rate >= 75 ? 'warning' : 'danger');
                  ?>
                  <li class="d-flex <?= $isLast ? '' : 'mb-3 pb-1' ?>">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2" style="min-width: 90px;">
                        <h6 class="mb-0"><?= $d['day'] ?></h6>
                        <small class="text-muted"><?= $d['absent'] ?> absent<?= $d['late'] > 0 ? ', ' . $d['late'] . ' late' : '' ?></small>
                      </div>
                      <div class="d-flex align-items-center gap-2 flex-grow-1">
                        <div class="progress flex-grow-1" style="height: 6px;">
                          <div class="progress-bar bg-<?= $color ?>" style="width: <?= $rate ?>%"></div>
                        </div>
                        <span class="fw-semibold text-<?= $color ?>" style="min-width: 38px; font-size: 0.8rem;"><?= $rate ?>%</span>
                      </div>
                    </div>
                  </li>
                  <?php endforeach; ?>

                </ul>
              </div>
            </div>
          </div>

          <!-- Students Needing Attention -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h5 class="card-title m-0">Needs Attention</h5>
                <small class="text-muted">Frequent absences or low grades</small>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">

                  <?php
                  $flagged = [
                    ['name' => 'Juan dela Cruz',   'issue' => '4 absences this week',  'color' => 'danger'],
                    ['name' => 'Maria Santos',      'issue' => 'Average below 75',       'color' => 'warning'],
                    ['name' => 'Pedro Reyes',       'issue' => '3 absences this week',  'color' => 'danger'],
                    ['name' => 'Ana Gomez',         'issue' => 'Late 3x this week',     'color' => 'warning'],
                    ['name' => 'Carlo Villanueva',  'issue' => 'No grade encoded yet',  'color' => 'info'],
                  ];
                  foreach ($flagged as $index => $student):
                    $isLast = $index === count($flagged) - 1;
                  ?>
                  <li class="d-flex <?= $isLast ? '' : 'mb-3 pb-1' ?>">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded-circle bg-label-<?= $student['color'] ?>">
                        <?= strtoupper(substr($student['name'], 0, 1)) ?>
                      </span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0"><?= htmlspecialchars($student['name']) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($student['issue']) ?></small>
                      </div>
                      <span class="badge bg-label-<?= $student['color'] ?>">!</span>
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
                <small class="text-muted">Teacher shortcuts</small>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2">

                  <a href="/teacher/attendance/record" class="btn btn-outline-success d-flex align-items-center gap-2">
                    <i class="bx bx-calendar-check"></i>
                    <span>Record Attendance</span>
                  </a>

                  <a href="/teacher/attendance" class="btn btn-outline-info d-flex align-items-center gap-2">
                    <i class="bx bx-calendar"></i>
                    <span>View Attendance Records</span>
                  </a>

                  <a href="/teacher/grades/encode" class="btn btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bx bx-edit"></i>
                    <span>Encode Grades</span>
                  </a>

                  <a href="/teacher/grades" class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bx bxs-book-open"></i>
                    <span>View Academic Records</span>
                  </a>

                  <a href="/teacher/students" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                    <i class="bx bx-list-ul"></i>
                    <span>View My Students</span>
                  </a>

                </div>
              </div>
            </div>
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
    <script src="../../../public/assets/js/main.js"></script>
</body>
</html>