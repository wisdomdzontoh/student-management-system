</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var editModal = new bootstrap.Modal(document.getElementById('editStudentModal'), {});

    function openEditModal(student) {
        document.getElementById('edit-id').value = student.id;
        document.getElementById('edit-name').value = student.name;
        document.getElementById('edit-age').value = student.age;
        document.getElementById('edit-gender').value = student.gender;
        document.getElementById('edit-email').value = student.email;
        document.getElementById('edit-program').value = student.program;
        document.getElementById('edit-level').value = student.level;
        document.getElementById('edit-session').value = student.session;
        document.getElementById('edit-cgpa').value = student.cgpa;
        document.getElementById('edit-certificate_awarded').value = student.certificate_awarded;
        editModal.show();
    }

    function openViewModal(student) {
        document.getElementById('view-id').value = student.id;
        document.getElementById('view-name').value = student.name;
        document.getElementById('view-age').value = student.age;
        document.getElementById('view-gender').value = student.gender;
        document.getElementById('view-email').value = student.email;
        document.getElementById('view-program').value = student.program;
        document.getElementById('view-level').value = student.level;
        document.getElementById('view-session').value = student.session;
        document.getElementById('view-cgpa').value = student.cgpa;
        document.getElementById('view-certificate_awarded').value = student.certificate_awarded;
        var viewModal = new bootstrap.Modal(document.getElementById('viewStudentModal'));
        viewModal.show();
    }
</script>
</body>

</html>