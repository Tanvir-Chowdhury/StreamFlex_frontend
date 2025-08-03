<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Handle removal
if (isset($_GET['remove'])) {
  $remove_id = intval($_GET['remove']);
  $removeStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND movie_id = ?");
  $removeStmt->bind_param("ii", $user_id, $remove_id);
  $removeStmt->execute();
  header("Location: cart.php");
  exit();
}

// Fetch cart items
$cart_items_details = [];
$subtotal = 0.00;

$stmt = $conn->prepare("
    SELECT m.movie_id, m.title, m.rating, m.price, m.poster_image_url
    FROM cart c
    JOIN movies m ON c.movie_id = m.movie_id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $cart_items_details[] = $row;
  $subtotal += $row['price'];
}

$_SESSION['cart_movie_ids'] = array_column($cart_items_details, 'movie_id');


define("TAX_RATE", 0.015);
$taxes = $subtotal * TAX_RATE;
$total = $subtotal + $taxes;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Cart - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="preload" as="stylesheet" />
  <link rel="preload" as="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="preload" as="stylesheet" href="css/brand.css" />
  <link rel="preload" as="stylesheet" href="css/navbar.css" />
  <link rel="preload" as="stylesheet" href="css/cart.css" />
</head>

<body style="padding-top: 70px; background-color: var(--bg-primary); color: var(--text-primary);">

  <?php include 'navbar.php'; ?>

  <main class="container my-5">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="h2 mb-4 fw-bold">Your Cart</h1>

        <?php if (empty($cart_items_details)): ?>
          <div id="empty-cart-message">
            <h3 class="text-secondary">Your cart is empty</h3>
            <p style="color: var(--text-tertiary);">Looks like you haven't added any movies to your cart yet.</p>
            <a href="movies.php" class="btn btn-primary mt-3">Browse Movies</a>
          </div>
        <?php else: ?>
          <div id="cart-items-container">
            <?php foreach ($cart_items_details as $item): ?>
              <div class="cart-item d-flex align-items-center justify-content-between mb-3 p-3 border rounded">
                <div class="d-flex align-items-center">
                  <img src="<?php echo htmlspecialchars($item['poster_image_url']); ?>"
                    alt="<?php echo htmlspecialchars($item['title']); ?>" class="cart-item-img me-3"
                    style="width: 80px; height: 120px; object-fit: cover;"
                    onerror="this.onerror=null;this.src='https://placehold.co/80x120/1f2937/ffffff?text=Image+Not+Found';">
                  <div>
                    <h5 class="mb-1"><?php echo htmlspecialchars($item['title']); ?></h5>
                    <div class="text-muted">
                      <i class="bi bi-star-fill text-warning"></i>
                      <?php echo htmlspecialchars($item['rating']); ?> IMDb
                    </div>
                  </div>
                </div>
                <div class="text-end">
                  <div>BDT <?php echo number_format($item['price'], 2); ?></div>
                  <a href="cart.php?remove=<?php echo $item['movie_id']; ?>" class="btn btn-sm btn-outline-danger mt-2">
                    <i class="bi bi-x-lg"></i> Remove
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-lg-4">
        <div class="summary-card p-4 border rounded">
          <h2 class="summary-title h5 mb-3">Order Summary</h2>
          <div class="summary-item d-flex justify-content-between mb-2">
            <span>Subtotal</span>
            <span>BDT <?php echo number_format($subtotal, 2); ?></span>
          </div>
          <div class="summary-item d-flex justify-content-between mb-2">
            <span>Tax (<?php echo TAX_RATE * 100; ?>%)</span>
            <span>BDT <?php echo number_format($taxes, 2); ?></span>
          </div>
          <hr>
          <div class="summary-item d-flex justify-content-between fw-bold">
            <span>Total</span>
            <span>BDT <?php echo number_format($total, 2); ?></span>
          </div>


          <form method="POST" action="payment.php" class="d-grid mt-4">
            <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
            <input type="hidden" name="taxes" value="<?php echo $taxes; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit" class="btn btn-primary <?php echo empty($cart_items_details) ? 'disabled' : ''; ?>">
              Proceed to Checkout
            </button>
          </form>
        </div>
      </div>

    </div>
  </main>

  <?php include 'footer.php'; ?>

</body>

</html>