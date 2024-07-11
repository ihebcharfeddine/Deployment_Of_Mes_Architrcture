<?php
header('Content-Type: application/json');
include "./config/db.php";
// Validate and sanitize the input
$id = isset($_POST['id']) ? (int) validateInput($_POST['id']) : 0;

if ($id <= 0) {
    jsonResponse(['error' => 'Invalid ID'], 400);
}
// Delete the student record
$stmt = $db->prepare("DELETE FROM student WHERE id = ?");
$result = $stmt->execute([$id]);
// Return the result as JSON
jsonResponse([
    'id' => $id,
    'success' => $result
]);
