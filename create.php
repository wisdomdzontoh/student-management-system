<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $level = $_POST['level'];
    $session = $_POST['session'];
    $cgpa = $_POST['cgpa'];
    $certificate_awarded = $_POST['certificate_awarded'];

    $sql = "INSERT INTO students (name, age, gender, email, program, level, session, cgpa, certificate_awarded) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $age, $gender, $email, $program, $level, $session, $cgpa, $certificate_awarded]);
        header("Location: index.php?status=success");
    } catch (Exception $e) {
        header("Location: index.php?status=error");
    }
    exit;
}
