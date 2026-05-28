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
            <i class="bx bx-book-open" style="font-size: 28px; color: #696cff;"></i>
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

        <!-- Students Record -->
        <li class="menu-item <?php echo ($currentPage === 'enroll-students.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Students Record">Students Record</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="enroll-students.php" class="menu-link">
                <div data-i18n="Account">Manage Students</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Manage Guardians -->
        <li class="menu-item <?php echo ($currentPage === 'student-guardian.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Manage Guardians">Manage Guardians</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="student-guardian.php" class="menu-link">
                <div data-i18n="Basic">Manage Guardians</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Subjects -->
        <li class="menu-item <?php echo ($currentPage === 'subjects.php') ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Subjects">Subjects</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="subjects.php" class="menu-link">
                <div data-i18n="Error">Manage Subjects</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Sections -->
        <li class="menu-item <?php echo ($currentPage === 'sections.php') || ($currentPage === 'student-sections.php') || ($currentPage === 'section-subjects.php') ? 'active' : '';  ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-grid-alt"></i>
            <div data-i18n="Sections">Sections</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="sections.php" class="menu-link">
                <div data-i18n="Error">Manage Sections</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="student-sections.php" class="menu-link">
                <div data-i18n="Error">Create Student Section</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="section-subjects.php" class="menu-link">
                <div data-i18n="Error">Section Subjects</div>
              </a>
            </li>

          </ul>
        </li>
      </ul>
    </aside>
    <!-- / Menu -->

    <!-- Layout page -->
    <div class="layout-page">