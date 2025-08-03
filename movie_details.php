<?php
include 'connection.php';

if (isset($_GET['movie_id'])) {
  $movieId = intval($_GET['movie_id']);

  $stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
  $stmt->bind_param("i", $movieId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
  } else {
    echo "Movie not found.";
    exit;
  }
} else {
  echo "No movie selected.";
  exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>StreamFlex - Movie Details</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/brand.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/movie_details.css" />
</head>

<body style="background-color: var(--bg-primary); color: var(--text-primary)">

  <!-- Navbar -->
  <?php require 'navbar.php'; ?>

  <!-- Main Content -->
  <main class="container" style="padding-top: 100px">
    <!-- Trailer Section -->
    <div class="movie-trailer mb-5 text-center">
      <div class="trailer-wrapper">
        <iframe width="720" height="405" src="<?php echo htmlspecialchars($movie['trailer_url']); ?>"
          title="<?php echo htmlspecialchars($movie['title']); ?>" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>

    <div class="movie-info mb-4">
      <h2 class="mb-3"><?php echo htmlspecialchars($movie['title']); ?></h2>
      <p style="color: var(--text-primary);" class=" mb-3">
        <?php echo htmlspecialchars($movie['description']); ?>
      </p>
      <div class="meta-info">
        <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
      </div>
    </div>

    <div class="rating-review mb-4">
      <h5>
        <i class="bi bi-star-fill" style="color: var(--gold)"></i> <?php echo htmlspecialchars($movie['rating']); ?>/10
        IMDb
        Rating
      </h5>
    </div>

    <div class="action-buttons d-flex gap-3 flex-wrap mb-5">
      <?php if ($_SESSION["role_id"] == 1) {
        echo '<a
          href="watch_movie.php?movie_id=' . $movie['movie_id'] . '"
          class="btn btn-light text-dark fw-semibold px-4 py-2"
          ><i class="bi bi-play-fill me-2"></i>Watch Movie</a
        >';
      } else {
        if ($user_id) {
          include 'connection.php';
          $stmt = $conn->prepare("SELECT * FROM purchases WHERE user_id = ? AND movie_id = ?");
          $stmt->bind_param("ii", $user_id, $movie_id);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            echo '<a
          href="watch_movie.php?movie_id=' . $movie['movie_id'] . '"
          class="btn btn-light text-dark fw-semibold px-4 py-2"
          ><i class="bi bi-play-fill me-2"></i>Watch Movie</a
        >';
          } else {
            echo '<a href="add_to_cart.php?movie_id='.$movie['movie_id'].'" class="btn btn-outline-light px-4 py-2">
        <i class="bi bi-cart-plus me-2"></i>Add to Cart
      </a>

      <a href="./subscription.php"><button class="btn btn-secondary px-4 py-2">
          <i class="bi bi-box-arrow-in-down me-2"></i>Subscribe to Watch
        </button></a>';
          }

          $stmt->close();
        } else {
          echo 'login.php';
        }
      } ?>
    </div>

    <!-- Footer -->
    <?php require 'footer.php'; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="js/movie_details.js" defer></script>
</body>

</html>