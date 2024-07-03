<?php
include 'config/database.php';
include 'includes/header.php';

$stmt = $pdo->query('SELECT * FROM students');
$students = $stmt->fetchAll();

if (isset($_GET['status'])) {
    $status = $_GET['status'];
}
?>

<?php if (isset($status) && $status == 'success') : ?>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <script>
        Toastify({
            text: "Success",
            duration: 4000,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            className: "custom-toast",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            close: true, // Show close button
            offset: {
                x: 20, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: 70, // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
                boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)",
                borderRadius: "8px",
                fontFamily: "Arial, sans-serif",
                color: "white",
                padding: "10px 20px",
                fontSize: "16px",
            },
        }).showToast();
    </script>
<?php elseif (isset($status) && $status == 'error') : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        There was an error adding the student.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h2 class="my-4">Students List</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Program</th>
            <th>Level</th>
            <th>Session</th>
            <th>CGPA</th>
            <th>Certificate Awarded</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?= htmlspecialchars($student['id']) ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['age']) ?></td>
                <td><?= htmlspecialchars($student['gender']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['program']) ?></td>
                <td><?= htmlspecialchars($student['level']) ?></td>
                <td><?= htmlspecialchars($student['session']) ?></td>
                <td><?= htmlspecialchars($student['cgpa']) ?></td>
                <td><?= htmlspecialchars($student['certificate_awarded']) ?></td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="openViewModal(<?= htmlspecialchars(json_encode($student)) ?>)">View</button>
                    <button class="btn btn-warning btn-sm" onclick="openEditModal(<?= htmlspecialchars(json_encode($student)) ?>)">Edit</button>
                    <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm" action="create.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" id="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" class="form-select" id="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="program" class="form-label">Program</label>
                        <select name="program" class="form-select" id="program" required>
                            <option value="">Select Program</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Business Administration">Business Administration</option>
                            <!-- Add more programs as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="number" name="level" class="form-control" id="level" required>
                    </div>
                    <div class="mb-3">
                        <label for="session" class="form-label">Session</label>
                        <select name="session" class="form-select" id="session" required>
                            <option value="">Select Session</option>
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                            <option value="Weekend">Weekend</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cgpa" class="form-label">CGPA</label>
                        <input type="number" step="0.01" name="cgpa" class="form-control" id="cgpa" required>
                    </div>
                    <div class="mb-3">
                        <label for="certificate_awarded" class="form-label">Certificate Awarded</label>
                        <select name="certificate_awarded" class="form-select" id="certificate_awarded" required>
                            <option value="">Select Certificate</option>
                            <option value="Bachelor's Degree">Bachelor's Degree</option>
                            <option value="Master's Degree">Master's Degree</option>
                            <option value="PhD">PhD</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm" action="update.php" method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="edit-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" id="edit-age" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-gender" class="form-label">Gender</label>
                        <select name="gender" class="form-select" id="edit-gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="edit-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-program" class="form-label">Program</label>
                        <select name="program" class="form-select" id="edit-program" required>
                            <option value="">Select Program</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Business Administration">Business Administration</option>
                            <!-- Add more programs as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-level" class="form-label">Level</label>
                        <input type="number" name="level" class="form-control" id="edit-level" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-session" class="form-label">Session</label>
                        <select name="session" class="form-select" id="edit-session" required>
                            <option value="">Select Session</option>
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                            <option value="Weekend">Weekend</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-cgpa" class="form-label">CGPA</label>
                        <input type="number" step="0.01" name="cgpa" class="form-control" id="edit-cgpa" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-certificate_awarded" class="form-label">Certificate Awarded</label>
                        <select name="certificate_awarded" class="form-select" id="edit-certificate_awarded" required>
                            <option value="">Select Certificate</option>
                            <option value="Bachelor's Degree">Bachelor's Degree</option>
                            <option value="Master's Degree">Master's Degree</option>
                            <option value="PhD">PhD</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">View Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <label for="view-id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="view-id" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="view-name" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="view-age" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-gender" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="view-gender" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="view-email" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-program" class="form-label">Program</label>
                    <input type="text" class="form-control" id="view-program" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-level" class="form-label">Level</label>
                    <input type="number" class="form-control" id="view-level" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-session" class="form-label">Session</label>
                    <input type="text" class="form-control" id="view-session" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-cgpa" class="form-label">CGPA</label>
                    <input type="number" step="0.01" class="form-control" id="view-cgpa" readonly>
                </div>
                <div class="mb-3">
                    <label for="view-certificate_awarded" class="form-label">Certificate Awarded</label>
                    <input type="text" class="form-control" id="view-certificate_awarded" readonly>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'includes/footer.php'; ?>