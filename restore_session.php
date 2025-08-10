<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id'])) {
    $_SESSION['user_id'] = intval($data['user_id']);
    $_SESSION['cart_movie_ids'] = $data['cart_movie_ids'] ?? [];
    $_SESSION['total'] = floatval($data['total'] ?? 0);

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Missing user_id"]);
}
