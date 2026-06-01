document.getElementById('editModal').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    
    document.getElementById('assign_subject_id').value = button.getAttribute('data-id');
    document.getElementById('edit_section_id').value = button.getAttribute('data-section-id');
    document.getElementById('edit_subject_id').value = button.getAttribute('data-subject-id');
});

// Reset form when assign modal opens
document.getElementById('assignSubjectModal').addEventListener('show.bs.modal', function (event) {
    document.getElementById('section_id').value = '';
    document.getElementById('subject_ids').selectedIndex = -1;
}); 