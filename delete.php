<?php
include 'config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit;
