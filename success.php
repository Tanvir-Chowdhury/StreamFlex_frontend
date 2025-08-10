<?php
session_start();
include 'connection.php';

// Try restoring from session if available
$user_id = $_SESSION['user_id'] ?? null;
$movie_ids = $_SESSION['cart_movie_ids'] ?? null;
$total = $_SESSION['total'] ?? 0;

// If session isn't restored yet, we will try restoring it via IndexedDB + JS
$needs_restore = !$user_id || !$movie_ids;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="refresh" content="5;url=user_dashboard.php">
  <title>Payment Successful</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      display: flex; justify-content: center; align-items: center;
      height: 100vh; background-color: #f8f9fa;
      font-family: sans-serif; text-align: center;
    }
    .message-container {
      padding: 40px; border-radius: 10px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    h2 { color: #28a745; }
    p { font-size: 1.1rem; }
  </style>
</head>
<body>
  <div class="message-container">
    <h2 class="mb-3">Payment Successful!</h2>
    <p>Thank you for your purchase. Your transaction was completed successfully.</p>
    <p>You will be redirected to your dashboard shortly.</p>
    <div class="spinner-border text-success mt-3" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

<?php if (!$needs_restore): ?>
<?php
  $payment_method = 'SSLCommerz';
  $status = 'completed';

  $conn->begin_transaction();

  try {
      $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, payment_method, status) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("idss", $user_id, $total, $payment_method, $status);
      $stmt->execute();

      $transaction_db_id = $stmt->insert_id;

      $purchaseStmt = $conn->prepare("INSERT INTO purchases (user_id, movie_id, transaction_id) VALUES (?, ?, ?)");
      foreach ($movie_ids as $movie_id) {
          $purchaseStmt->bind_param("iii", $user_id, $movie_id, $transaction_db_id);
          $purchaseStmt->execute();
      }

      $deleteCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
      $deleteCart->bind_param("i", $user_id);
      $deleteCart->execute();

      $conn->commit();

      // Clear session data
      unset($_SESSION['cart_movie_ids']);
      unset($_SESSION['total']);
  } catch (mysqli_sql_exception $exception) {
      $conn->rollback();
      header('Location: fail.php');
      exit();
  }
?>
<?php endif; ?>

<script>
const needsRestore = <?php echo json_encode($needs_restore); ?>;
if (needsRestore) {
  const dbName = "StreamFlexSessionDB";
  const storeName = "sessionData";

  function restoreSession() {
    const request = indexedDB.open(dbName);
    request.onsuccess = function (event) {
      const db = event.target.result;
      const tx = db.transaction(storeName, "readonly");
      const store = tx.objectStore(storeName);

      const keys = ["user_id", "cart_movie_ids", "total"];
      const data = {};
      let completed = 0;

      keys.forEach(key => {
        const req = store.get(key);
        req.onsuccess = () => {
          data[key] = req.result ? req.result.value : null;
          completed++;
          if (completed === keys.length) {
            // Send to backend
            fetch("restore_session.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(data)
            }).then(res => res.json())
              .then(res => {
                if (res.success) {
                  console.log("Session restored. Reloading...");
                  // Clear IndexedDB
                  const txDel = db.transaction(storeName, "readwrite");
                  const storeDel = txDel.objectStore(storeName);
                  keys.forEach(k => storeDel.delete(k));
                  txDel.oncomplete = () => {
                    db.close();
                    location.reload(); // Reload to process transaction
                  };
                }
              });
          }
        };
      });
    };
  }

  restoreSession();
}
</script>

</body>
</html>
