document.getElementById('editModal').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    
    document.getElementById('assign_subject_id').value = button.getAttribute('data-id');
    document.getElementById('edit_section_id').value = button.getAttribute('data-section-id');
    document.getElementById('edit_subject_id').value = button.getAttribute('data-subject-id');
}); 