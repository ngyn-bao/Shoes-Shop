<?php
header("Content-Type: application/json");
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode([
        "logged_in" => false
    ]);
    exit;
}

echo json_encode([
    "logged_in" => true,
    "user" => $_SESSION['user']
]);
