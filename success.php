<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['cart_movie_ids'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$movie_ids = $_SESSION['cart_movie_ids'];
$total = $_SESSION['total'] ?? 0;
$txn_id = uniqid('txn_');
$txn_date = date('Y-m-d H:i:s');

// 1. Insert into transactions
$stmt = $conn->prepare("INSERT INTO transactions (transaction_id, user_id, amount, transaction_date, status) VALUES (?, ?, ?, ?, 'success')");
$stmt->bind_param("sids", $txn_id, $user_id, $total, $txn_date);
$stmt->execute();

// 2. Insert into purchases
$purchaseStmt = $conn->prepare("INSERT INTO purchases (user_id, movie_id, purchase_date) VALUES (?, ?, ?)");
foreach ($movie_ids as $movie_id) {
    $purchaseStmt->bind_param("iis", $user_id, $movie_id, $txn_date);
    $purchaseStmt->execute();
}

// 3. Delete from cart
$deleteCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
$deleteCart->bind_param("i", $user_id);
$deleteCart->execute();

// Optional: Unset session cart
unset($_SESSION['cart_movie_ids']);
unset($_SESSION['total']);

echo "<h2 style='color: green;'>✅ Payment Successful!</h2>";
echo "<p>Thank you for your purchase. Transaction ID: <strong>$txn_id</strong></p>";
echo "<a href='user_dashboard.php'>Go to Dashboard</a>";
?>
