<?php
header('Content-Type: application/json');
include "./config/db.php";

// Validate and sanitize the input
$id = isset($_POST['id']) ? (int) validateInput($_POST['id']) : 0;

if ($id <= 0) {
    jsonResponse(['error' => 'Invalid ID'], 400);
}

// Fetch the specific student record
$stmt = $db->prepare("SELECT name, age FROM student WHERE id = ?");
$stmt->execute([$id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the result as JSON
jsonResponse(['result' => $result]);
