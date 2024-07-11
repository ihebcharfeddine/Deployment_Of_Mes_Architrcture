<?php
header('Content-Type: application/json');
include "./config/db.php";

// Validate and sanitize the inputs
$id = isset($_POST['id']) ? (int) validateInput($_POST['id']) : 0;
$name = validateInput($_POST['name']);
$age = isset($_POST['age']) ? (int) validateInput($_POST['age']) : 0;

if ($id <= 0 || $age <= 0 || empty($name)) {
    jsonResponse(['error' => 'Invalid input data'], 400);
}

// Update the student record
$stmt = $db->prepare("UPDATE student SET name = ?, age = ? WHERE id = ?");
$result = $stmt->execute([$name, $age, $id]);

// Return success status as JSON
jsonResponse(['success' => $result]);
