<?php
session_start();
include 'connection.php'; 
if (isset($_SESSION['user_id']) && isset($_SESSION['total'])) {
    $user_id = $_SESSION['user_id'];
    $total = $_SESSION['total'];
    $payment_method = 'SSLCommerz';
    $status = 'failed'; // 

    // Log the failed transaction attempt to the database
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, payment_method, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $user_id, $total, $payment_method, $status);
    $stmt->execute();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=user_dashboard.php">
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; font-family: sans-serif; text-align: center; }
        .message-container { padding: 40px; border-radius: 10px; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { color: #dc3545; }
        p { font-size: 1.1rem; }
    </style>
</head>
<body>
    <div class="message-container">
        <h2 class="mb-3"> Payment Failed</h2>
        <p>Unfortunately, your transaction could not be completed.</p>
        <p>This attempt has been logged. You will be redirected to your dashboard.</p>
        <p class="mt-4"><a href="cart.php" class="btn btn-primary">Try Again</a> or <a href="user_dashboard.php" class="btn btn-secondary">Go to Dashboard Now</a></p>
    </div>
</body>
</html>
