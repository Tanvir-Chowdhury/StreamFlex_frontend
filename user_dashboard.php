<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT username FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$user_name = $user['username'];


$subStmt = $conn->prepare("SELECT start_date, end_date, status FROM subscriptions WHERE user_id = ? ORDER BY end_date DESC LIMIT 1");
$subStmt->bind_param("i", $user_id);
$subStmt->execute();
$subResult = $subStmt->get_result();
$subscription = $subResult->fetch_assoc();

$subStatus = "You are not currently subscribed.";
$sub_status = 0;
if ($subscription && $subscription['status'] === 'active') {
  $subStatus = "You are currently subscribed. Valid till <strong>" . htmlspecialchars($subscription['end_date']) . "</strong>.";
  $sub_status = 1;
}


$sql = "SELECT 
            m.movie_id, 
            m.title, 
            m.description, 
            m.release_year, 
            m.price, 
            m.trailer_url,
            m.imdb_url, 
            m.tmdb_url, 
            m.movie_file_url, 
            m.poster_image_url, 
            m.uploaded_by, 
            m.created_at, 
            m.genre, 
            m.rating, 
            m.language
        FROM purchases p
        JOIN movies m ON p.movie_id = m.movie_id
        WHERE p.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$movie_array2 = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $movie_array2[] = $row;
  }
} else {
  // No movies found
}

$javascript_movie_array2 = json_encode($movie_array2);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Dashboard - StreamFlex</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/brand.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/user_dashboard.css" />
</head>

<body style="background-color: var(--bg-primary); color: var(--text-primary)">
  <!-- Navbar -->
  <?php require 'navbar.php'; ?>

  <main class="container" style="padding-top: 100px;">
    <h2 class="text-center mb-4">Welcome, <?php echo $user_name; ?></h2>

    <section class="mb-5">
      <h3 class="fw-bold mb-3" style="color: #f8fafc;">Subscription Status</h3>
      <p><?php echo $subStatus ?> </p>
      <?php if ($sub_status === 0) {
        echo '<button class="btn btn-outline-light" onclick="window.location.href=\'subscription.php\'">Manage Subscription</button>';
      } ?>
    </section>

    <section class="mb-5">
      <h3 class="fw-bold mb-3" style="color: #f8fafc;">Favourite Movies</h3>
      <p style="color:var(--text-tertiary)">Feature coming soon...</p>
    </section>

    <section class="mb-5">
      <h3 class="fw-bold mb-3" style="color: #f8fafc;">Purchased Movies</h3>
      <div class="movie-wrapper">
        <div class="movie-container" id="movieList"></div>
      </div>

      <div class="text-center mt-4 mb-4">
        <button id="loadMoreBtn" class="btn btn-outline-light" onclick="loadMore()">
          Load More
        </button>
      </div>
    </section>

    <section>
      <h3 class="fw-bold mb-3" style="color: #f8fafc;">Edit Profile</h3>
      <button class="btn btn-outline-light">Edit Profile Info</button>
    </section>
    <div class="text-end mb-4">
      <a href="logout.php" class="btn btn-outline-danger">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>
  </main>

  <!-- Footer -->
  <?php require 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="js/user_dashboard.js" defer></script>
  <script defer>
    const movies2 = <?php echo $javascript_movie_array2; ?>;
  </script>
</body>

</html>