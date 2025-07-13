
<?php

include '../connection.php';



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - StreamFlex</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/brand.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="./css/admin_dashboard.css" />
  </head>
  <body style="background-color: var(--bg-primary); color: var(--text-primary)">
    <!-- Navbar -->
    <?php require '../navbar.php'; ?>

    <!-- Content -->
    <main class="container" style="padding-top: 100px">
      <h2 class="mb-4 fw-bold">Admin Dashboard</h2>

      <!-- Stats -->
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="stat-card bg-dark text-white p-4 rounded">
            <h5>Total Users</h5>
            <h2><?php echo $userCount; ?></h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card bg-dark text-white p-4 rounded">
            <h5>Subscribers</h5>
            <h2><?php echo $subscriberCount; ?></h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card bg-dark text-white p-4 rounded">
            <h5>Purchases</h5>
            <h2><?php echo $purchaseCount; ?></h2>
          </div>
        </div>
      </div>

      <!-- Recently Uploaded -->
      <div class="section mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="fw-semibold">Recently Uploaded Movies</h4>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <div class="movie-card">
            <img src="../images/avatar.jpg" alt="Avatar" class="movie-thumb" />
            <div class="movie-meta">Avatar<br /><span>2009 · Action</span></div>
          </div>
          <div class="movie-card">
            <img src="../images/matrix.jpg" alt="Matrix" class="movie-thumb" />
            <div class="movie-meta">Matrix<br /><span>1999 · Crime</span></div>
          </div>
          <div class="movie-card">
            <img
              src="../images/titanic.jpg"
              alt="Titanic"
              class="movie-thumb"
            />
            <div class="movie-meta">
              Titanic<br /><span>1997 · Sci-Fi</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="section mb-5">
        <h4 class="fw-semibold mb-3">Quick Actions</h4>
        <div class="d-flex flex-wrap gap-3">
          <a href="./movie_management.html"
            ><button class="btn btn-purple">Update Movies</button></a
          >
          <a href="./admin_user_management.html"
            ><button class="btn btn-outline-light">View Users</button></a
          >
          <a href="./transactions.html"
            ><button class="btn btn-outline-light">
              View All Purchases
            </button></a
          >
        </div>
      </div>
    </main>

    <!-- Footer -->
    <?php require '../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin_dashboard.js"></script>
  </body>
</html>
