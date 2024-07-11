<?php
header('Content-Type: application/json');
include "./config/db.php";

// Fetch all student records
$stmt = $db->prepare("SELECT id, name, age FROM student");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the results as JSON
jsonResponse($result);


