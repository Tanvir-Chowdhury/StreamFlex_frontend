<?php
session_start();
include 'connection.php';

// Redirect if user is not logged in or cart is empty
if (!isset($_SESSION['user_id']) || empty($_SESSION['cart_movie_ids'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$movie_ids = $_SESSION['cart_movie_ids'];
$total = $_SESSION['total'] ?? 0;

$payment_method = 'SSLCommerz';
$status = 'completed'; // Set status to 'completed' as per the ENUM definition in your SQL

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, payment_method, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $user_id, $total, $payment_method, $status);
    $stmt->execute();
    
    // Get the auto-incremented transaction_id from the insert operation
    $transaction_db_id = $stmt->insert_id;
    $purchaseStmt = $conn->prepare("INSERT INTO purchases (user_id, movie_id, transaction_id) VALUES (?, ?, ?)");
    foreach ($movie_ids as $movie_id) {
        $purchaseStmt->bind_param("iii", $user_id, $movie_id, $transaction_db_id);
        $purchaseStmt->execute();
    }

    // 3. Clear the user's cart
    $deleteCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $deleteCart->bind_param("i", $user_id);
    $deleteCart->execute();

    // If all queries were successful, commit the transaction
    $conn->commit();

} catch (mysqli_sql_exception $exception) {
    // If any query fails, roll back the transaction
    $conn->rollback();
    header('Location: fail.php');
    exit();
}

// --- Cleanup Session ---
unset($_SESSION['cart_movie_ids']);
unset($_SESSION['total']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- This meta tag will redirect the user to the dashboard after 3 seconds -->
    <meta http-equiv="refresh" content="3;url=user_dashboard.php">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; font-family: sans-serif; text-align: center; }
        .message-container { padding: 40px; border-radius: 10px; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { color: #28a745; }
        p { font-size: 1.1rem; }
    </style>
</head>
<body>
    <div class="message-container">
        <h2 class="mb-3">✅ Payment Successful!</h2>
        <p>Thank you for your purchase. Your transaction was completed successfully.</p>
        <p>You will be redirected to your dashboard shortly.</p>
        <div class="spinner-border text-success mt-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</body>
</html>
