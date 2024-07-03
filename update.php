<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $level = $_POST['level'];
    $session = $_POST['session'];
    $cgpa = $_POST['cgpa'];
    $certificate_awarded = $_POST['certificate_awarded'];

    $sql = "UPDATE students SET name = ?, age = ?, gender = ?, email = ?, program = ?, level = ?, session = ?, cgpa = ?, certificate_awarded = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $age, $gender, $email, $program, $level, $session, $cgpa, $certificate_awarded, $id]);

    header("Location: index.php?status=success");
    exit;
}
