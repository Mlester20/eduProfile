<?php
require_once __DIR__ . '/../../../app/controllers/registrar/AssignSectionSubjectController.php';
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
    <link rel="stylesheet" href="../../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../../public/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <script src="../../../public/assets/vendor/js/helpers.js"></script>
    <script src="../../../public/assets/js/config.js"></script>

    <style>
        .modal {
            z-index: 1050 !important;
        }
        .modal-backdrop {
            z-index: 1040 !important;
        }
        .select2-container {
            z-index: 1060 !important;
        }
        .select2-dropdown {
            z-index: 1060 !important;
        }
    </style>
</head>
<body>

    <?php showFlash(); ?>

    <?php require_once __DIR__ . '/partials/sidebar.php'; ?>
    <?php require_once __DIR__ . '/partials/topbar.php'; ?>

    <div class="text-end">
      <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#assignSubjectModal"
      >
        Assign Subject
      </button>
    </div>

    <!-- Assign Subject Modal -->
    <div class="modal fade" id="assignSubjectModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Assign Subjects to Section</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../../../app/controllers/registrar/AssignSectionSubjectController.php" method="post">
              <div class="mb-3">
                <label for="section_id" class="form-label">Section</label>
                <select name="section_id" id="section_id" class="form-select" required>
                  <option value="" disabled selected>Select a section</option>
                  <?php foreach($sections as $section): ?>
                    <option value="<?php echo htmlspecialchars($section['id']); ?>">
                      <?php echo htmlspecialchars($section['grade_level'] . ' - ' . $section['section_name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="subject_ids" class="form-label">Subjects</label>
                <select name="subject_ids[]" id="subject_ids" class="form-select" multiple="multiple" required>
                  <?php foreach($subjects as $subject): ?>
                    <option value="<?php echo htmlspecialchars($subject['id']); ?>">
                      <?php echo htmlspecialchars($subject['subject_name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <small class="form-text text-muted d-block mt-2">
                  <strong>Tip:</strong> Hold <kbd>Ctrl</kbd> (Windows/Linux) or <kbd>Cmd</kbd> (Mac) to select multiple subjects.
                </small>
              </div>
              <button type="submit" class="btn btn-primary" name="assign_subject">Assign Subjects</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Section Subject</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../../../app/controllers/registrar/AssignSectionSubjectController.php" method="post">
              <input type="hidden" id="assign_subject_id" name="assign_subject_id">
              <div class="mb-3">
                <label for="edit_section_id" class="form-label">Section</label>
                <select name="section_id" id="edit_section_id" class="form-select" required>
                  <option value="" disabled selected>Select a section</option>
                  <?php foreach($sections as $section): ?>
                    <option value="<?php echo htmlspecialchars($section['id']); ?>">
                      <?php echo htmlspecialchars($section['grade_level'] . ' - ' . $section['section_name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="edit_subject_id" class="form-label">Subject</label>
                <select name="subject_id" id="edit_subject_id" class="form-select" required>
                  <option value="" disabled selected>Select a subject</option>
                  <?php foreach($subjects as $subject): ?>
                    <option value="<?php echo htmlspecialchars($subject['id']); ?>">
                      <?php echo htmlspecialchars($subject['subject_name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary" name="update_assign_subject">Update Section Subject</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-4">
      <h5 class="card-header">Section Subjects</h5>
      <div class="table-responsive nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>School Year</th>
              <th>Year &amp; Section</th>
              <th>Subject</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($assignSubjects)): ?>
              <?php foreach($assignSubjects as $assignSubject): ?>
                <tr>
                  <td><?php echo htmlspecialchars($assignSubject['id']); ?></td>
                  <td><?php echo htmlspecialchars($assignSubject['school_year']); ?></td>
                  <td><?php echo htmlspecialchars($assignSubject['grade_level'] . ' - ' . $assignSubject['section_name']); ?></td>
                  <td><?php echo htmlspecialchars($assignSubject['subject_name']); ?></td>
                  <td>
                    <button
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                        data-id="<?php echo $assignSubject['id']; ?>"
                        data-section-id="<?php echo $assignSubject['section_id']; ?>"
                        data-subject-id="<?php echo $assignSubject['subject_id']; ?>"
                        class="btn btn-warning btn-sm">
                        Edit
                    </button>

                    <form action="../../../app/controllers/registrar/AssignSectionSubjectController.php" method="post" style="display: inline;">
                      <input type="hidden" name="delete_assign_subject" value="<?php echo $assignSubject['id']; ?>">
                      <button
                        type="submit"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this record?')"
                      >
                        Delete
                      </button>
                    </form>
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

    <!-- JS -->
    <script src="../../../public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../../public/assets/vendor/libs/popper/popper.js"></script>
    <script src="../../../public/assets/vendor/js/bootstrap.js"></script>
    <script src="../../../public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../public/assets/vendor/js/menu.js"></script>
    <script src="../../../public/assets/js/main.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="../../../public/js/registrar/assign-subject.js"></script>

    <script>
        // Initialize Select2 when the Assign modal opens
        $('#assignSubjectModal').on('shown.bs.modal', function () {
            if (!$('#subject_ids').data('select2')) {
                $('#subject_ids').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Select one or more subjects',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('#assignSubjectModal')
                });
            }
        });

        // Destroy Select2 when modal closes to avoid duplicate init issues
        $('#assignSubjectModal').on('hidden.bs.modal', function () {
            if ($('#subject_ids').data('select2')) {
                $('#subject_ids').select2('destroy');
            }
        });

        // Populate Edit modal fields
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const sectionId = button.getAttribute('data-section-id');
                const subjectId = button.getAttribute('data-subject-id');

                document.getElementById('assign_subject_id').value = id;
                document.getElementById('edit_section_id').value = sectionId;
                document.getElementById('edit_subject_id').value = subjectId;
            });
        });
    </script>
</body>
</html>