<?php
// Get current page name
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="home.php" class="app-brand-link">
          <span class="app-brand-logo demo">
            <img src="../../../../public/assets/img/favicon/logo.png" alt="logo" style="width: 50px; height: 50px;">
          </span>
          <span class="app-brand-text demo menu-text fw-bolder ms-2">EduProfile</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
          <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php echo ($currentPage === 'home.php') ? 'active' : ''; ?>">
          <a href="home.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Lists</span>
        </li>

        <!-- My Students -->
        <li class="menu-item <?php echo ($currentPage === 'my-students.php' || $currentPage === 'subject-lists.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="My Students">Students List</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="my-students.php" class="menu-link">
                <div data-i18n="Account">My Students</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="subject-lists.php" class="menu-link">
                <div data-i18n="Notifications">Subject Lists</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Attendance -->
        <li class="menu-item <?php echo ($currentPage === 'student-attendance.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div data-i18n="Attendance">Student Attendance</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="student-attendance.php" class="menu-link">
                <div data-i18n="Basic">Manage Attendance</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Academic Records -->
        <li class="menu-item <?php echo ($currentPage === 'academic-records.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Academic Records">Academic Records</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="academic-records.php" class="menu-link">
                <div data-i18n="Basic">Manage Records</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- record attendance -->
        <li class="menu-item <?php echo ($currentPage === 'record-attendance.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div data-i18n="Attendance">Record Attendance</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="record-attendance.php" class="menu-link">
                <div data-i18n="Basic">Record Attendance</div>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </aside>
    <!-- / Menu -->

    <!-- Layout page -->
    <div class="layout-page">