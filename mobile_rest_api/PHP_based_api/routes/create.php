<?php
header('Content-Type: application/json');
include "./config/db.php";

// Validate and sanitize the inputs
$name = validateInput($_POST['name']);
$age = isset($_POST['age']) ? (int) validateInput($_POST['age']) : 0;

if ($age <= 0 || empty($name)) {
    jsonResponse(['error' => 'Invalid input data'], 400);
}

// Insert a new student record
$stmt = $db->prepare("INSERT INTO student (name, age) VALUES (?, ?)");
$result = $stmt->execute([$name, $age]);

// Return success status as JSON
jsonResponse(['success' => $result]);
?>
