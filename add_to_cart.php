<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$movie_id = intval($_GET['movie_id'] ?? 0);

if ($movie_id > 0) {
    // Check if already in cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND movie_id = ?");
    $stmt->bind_param("ii", $user_id, $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Insert into cart
        $insert = $conn->prepare("INSERT INTO cart (user_id, movie_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $movie_id);
        $insert->execute();
    }

    header("Location: cart.php");
    exit();
}
?>
