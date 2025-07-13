<?php
// 1. START THE SESSION
session_start();

// 2. PROTECT THE PAGE
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// --- !!! IMPORTANT: DATABASE CONNECTION GOES HERE !!! ---
// include 'db_connection.php';

// 3. SIMULATE A "PRODUCTS" DATABASE
// In a real application, you would query your database for this data.
$products_db = [
    1 => ['id' => 1, 'title' => 'Civil War', 'thumbnail' => '/images/civilwar.jpg', 'rating' => 7.6, 'price' => 550.00],
    2 => ['id' => 2, 'title' => 'Avatar', 'thumbnail' => '/images/avatar.jpg', 'rating' => 8.7, 'price' => 700.00],
    3 => ['id' => 3, 'title' => 'The King\'s Man', 'thumbnail' => '/images/kingsman.jpg', 'rating' => 8.1, 'price' => 450.00]
];

// 4. INITIALIZE THE CART IN THE SESSION (if it doesn't exist)
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    // For demonstration, let's add some items to the cart automatically.
    // In your real app, items would be added from your movie pages.
    $_SESSION['cart'][1] = 1; // Key is product ID, value is quantity (always 1 for movies)
    $_SESSION['cart'][2] = 1;
}

// 5. HANDLE "REMOVE FROM CART" ACTION
if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id])
        header('Location: cart.php');
        exit();
    }
}

// 6. PREPARE CART ITEMS FOR DISPLAY
$cart_items_details = [];
$subtotal = 0.00;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product details from our simulated DB
        if (isset($products_db[$product_id])) {
            $product = $products_db[$product_id];
            $cart_items_details[] = $product;
            $subtotal += $product['price'] * $quantity;
        }
    }
}

// 7. CALCULATE TOTALS
const TAX_RATE = 0.015;
$taxes = $subtotal * TAX_RATE;
$total = $subtotal + $taxes;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/brand.css">
  <link rel="stylesheet" href="css/navbar.css">
</head>
<body style="padding-top: 70px;">
  <nav
      style="background-color: var(--bg-primary)"
      class="navbar navbar-expand-lg fixed-top py-2"
    >
      <div style="width: 80%" class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="index.php">
          Stream<span style="color: var(--brand-purple)">Flex</span>
        </a>

        <!-- mobile menu -->
        <button
          class="navbar-toggler navbar-dark text-white border-0"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarlinks"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- links -->
        <div class="collapse navbar-collapse" id="navbarlinks">
          <ul class="navbar-nav me-auto ms-3">
            <li class="nav-item">
              <a
                class="nav-link active text-white font-weight-bold"
                href="index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                style="color: var(--text-tertiary)"
                class="nav-link"
                href="movies.php"
                >Movies</a
              >
            </li>
            <li class="nav-item">
              <a
                style="color: var(--text-tertiary)"
                class="nav-link"
                href="series.php"
                >Series</a
              >
            </li>
            <li class="nav-item">
              <a
                style="color: var(--text-tertiary)"
                class="nav-link"
                href="subscription.php"
                >Subscription</a
              >
            </li>
          </ul>

          <div class="d-flex align-items-center">
            <!-- Search Input -->
            <form
              style="background-color: var(--bg-tertiary)"
              class="d-flex align-items-center px-3 rounded-pill"
              style="min-width: 250px"
            >
              <i
                style="color: var(--text-tertiary)"
                class="bi bi-search me-2"
              ></i>
              <input
                class="form-control border-0 bg-transparent text-white"
                type="search"
                placeholder="Search movies, series..."
                aria-label="Search"
              />
            </form>

            <!-- User Icon -->
            <div class="ms-3">
              <a href="login.php"><i
                style="color: var(--text-tertiary)"
                class="bi bi-person fs-5"
              ></i></a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  <main class="container my-5">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="h2 mb-4 fw-bold">Your Cart</h1>
        
        <?php if (empty($cart_items_details)): ?>
            <!-- This block shows if the cart is empty -->
            <div id="empty-cart-message">
                <h3 class="text-secondary">Your cart is empty</h3>
                <p class="text-muted">Looks like you haven't added any movies to your cart yet.</p>
                <a href="index.php" class="btn btn-primary mt-3">Browse Movies</a>
            </div>
        <?php else: ?>
            <!-- This block shows if the cart has items -->
            <div id="cart-items-container">
                <?php foreach ($cart_items_details as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['thumbnail']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="cart-item-img" onerror="this.onerror=null;this.src='https://placehold.co/80x120/1f2937/ffffff?text=Error';">
                        <div class="cart-item-details">
                            <div class="cart-item-title"><?php echo htmlspecialchars($item['title']); ?></div>
                            <div class="cart-item-rating">
                                <i class="bi bi-star-fill"></i>
                                <span><?php echo htmlspecialchars($item['rating']); ?></span>
                            </div>
                        </div>
                        <div class="cart-item-price">BDT <?php echo number_format($item['price'], 2); ?></div>
                        <a href="cart.php?remove=<?php echo $item['id']; ?>" class="remove-btn" title="Remove item">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

      </div>
      <div class="col-lg-4">
        <div class="summary-card">
          <h2 class="summary-title">Order Summary</h2>
          <div class="summary-item">
            <span>Subtotal</span>
            <span id="summary-subtotal">BDT <?php echo number_format($subtotal, 2); ?></span>
          </div>
          <div class="summary-item">
            <span>Taxes & Fees (<?php echo TAX_RATE * 100; ?>%)</span>
            <span id="summary-taxes">BDT <?php echo number_format($taxes, 2); ?></span>
          </div>
          <hr style="border-color: var(--bg-tertiary);">
          <div class="summary-item summary-total">
            <span>Total</span>
            <span id="summary-total">BDT <?php echo number_format($total, 2); ?></span>
          </div>
          <div class="d-grid mt-4">
            <!-- The button is disabled if the cart is empty -->
            <a href="payment.php" id="checkout-btn" class="btn btn-primary <?php if (empty($cart_items_details)) echo 'disabled'; ?>">
              Proceed to Checkout
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
    <footer
      style="background-color: var(--bg-primary); color: var(--text-tertiary)"
      class="pb-3"
    >
      <hr class="mb-4 mt-0" />
      <div class="container">
        <div class="row text-start">
          <div class="col-md-4 mb-4">
            <h5 class="fw-bold text-white">
              Stream<span style="color: var(--brand-purple)">Flex</span>
            </h5>
            <p class="text-secondary mb-0">
              Your ultimate destination for movies and series streaming.
            </p>
          </div>
          <div class="col-md-2 mb-4">
            <h6 class="fw-semibold text-white">Company</h6>
            <ul class="list-unstyled">
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="subscription.php"
                  class="text-decoration-none"
                  >Subscription</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="movies.php"
                  class="text-decoration-none"
                  >Movies</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="series.php"
                  class="text-decoration-none"
                  >Series</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h6 class="fw-semibold text-white">Support</h6>
            <ul class="list-unstyled">
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="#"
                  class="text-decoration-none"
                  >Help Center</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="contact.html"
                  class="text-decoration-none"
                  >Contact Us</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="#"
                  class="text-decoration-none"
                  >Privacy Policy</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h6 class="fw-semibold text-white">Follow Us</h6>
            <ul class="list-unstyled">
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="#"
                  class="text-decoration-none"
                  >Facebook</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="#"
                  class="text-decoration-none"
                  >Twitter</a
                >
              </li>
              <li>
                <a
                  style="color: var(--text-tertiary)"
                  href="#"
                  class="text-decoration-none"
                  >Instagram</a
                >
              </li>
            </ul>
          </div>
        </div>
        <hr class="border-secondary" />
        <div class="text-center text-secondary small">
          © 2024 StreamFlex. All rights reserved.
        </div>
      </div>
    </footer>

</body>
</html>
