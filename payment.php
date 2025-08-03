<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cart.php');
    exit();
}
$subtotal = isset($_POST['subtotal']) ? floatval($_POST['subtotal']) : 0;
$taxes    = isset($_POST['taxes'])    ? floatval($_POST['taxes'])    : 0;
$total    = isset($_POST['total'])    ? floatval($_POST['total'])    : 0;

$_SESSION['total'] = $total; 
$_SESSION['name'] = $user['username'];
$_SESSION['email'] = $user['email'];
$_SESSION['phone_number'] = $user['phone_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/payment.css" />
  <link rel="stylesheet" href="css/brand.css" />
  <link rel="stylesheet" href="css/navbar.css" />
</head>
<body style="padding-top: 70px; background-color: var(--bg-primary); color: var(--text-primary);">

<?php include 'navbar.php'; ?>

<main class="container my-5">
  <div class="row g-5">
    <div class="col-lg-7">
      <h1 class="h3 mb-4 fw-bold">Choose Payment Method</h1>

      <form id="sslcommerz-form">
        <div class="form-check mb-4 ml-4 bg-dark p-3 rounded" style="background-color: var(--bg-tertiary);">
          <input class="form-check-input ms-3 me-3" type="radio" name="paymentMethod" id="sslRadio" checked>
          <label class="form-check-label d-flex align-items-center gap-2" for="sslRadio">
            <span class="fs-5">Pay with SSLCommerz</span>
          </label>
        </div>
        <div class="d-grid">
          <button id="pay-now-btn" type="button" class="btn btn-primary btn-lg">
            Pay BDT <?php echo number_format($total, 2); ?>
          </button>
        </div>
      </form>
    </div>

    <div class="col-lg-5">
      <div class="p-4 border rounded" style="background-color: var(--bg-tertiary);">
        <h2 class="h5 mb-3">Order Summary</h2>
        <div class="d-flex justify-content-between mb-2">
          <span>Subtotal</span>
          <span>BDT <?php echo number_format($subtotal, 2); ?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Taxes & Fees (1.5%)</span>
          <span>BDT <?php echo number_format($taxes, 2); ?></span>
        </div>
        <hr class="border-light" />
        <div class="d-flex justify-content-between fw-bold">
          <span>Total</span>
          <span>BDT <?php echo number_format($total, 2); ?></span>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

<script>
document.getElementById("pay-now-btn").addEventListener("click", function () {
  const amount = <?php echo json_encode($total); ?>;

  fetch('ssl_payment.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      amount: amount,
      currency: 'BDT',
      cus_name: $_SESSION['name'],
      cus_email: $_SESSION['email'],
      cus_add1: 'Dhaka',
      cus_phone: $_SESSION['phone_number']
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.GatewayPageURL) {
      window.location.href = data.GatewayPageURL;
    } else {
      alert('Failed to initiate payment');
    }
  })
  .catch(error => {
    console.error('Payment initiation error:', error);
  });
});
</script>

</body>
</html>
