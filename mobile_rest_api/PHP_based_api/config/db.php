<?php

$db_name = "mes_db";
$db_server = "127.0.0.1";
$db_user = "root";
$db_pass = "";

try {
    $db = new PDO("mysql:host={$db_server};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    jsonResponse(['error' => $e->getMessage()], 500);
}

function jsonResponse($data, $status = 200) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}

function validateInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}