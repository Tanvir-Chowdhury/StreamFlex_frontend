<?php
include 'connection.php';

// movie deletion
if (isset($_GET['delete'])) {
    $movie_id = (int)$_GET['delete'];
    $delete_query = "DELETE FROM movies WHERE movie_id = $movie_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<p>Movie deleted successfully!</p>";
    } else {
        echo "<p>Error deleting movie: " . mysqli_error($conn) . "</p>";
    }
}

$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM movies WHERE title LIKE '%$searchTerm%' ORDER BY created_at DESC";
} else {
    $query = "SELECT * FROM movies ORDER BY created_at DESC";
}
$result = mysqli_query($conn, $query);
$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management - StreamFlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/brand.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/admin_dashboard.css" />
</head>
<body style="background-color: var(--bg-primary); color: var(--text-primary)">
  <!-- Navbar -->
  <?php require 'navbar.php'; ?>

  <!-- Content -->
  <main class="container" style="padding-top: 100px">
    <h2 class="mb-4 fw-bold">Movie Management</h2>

    <!-- Success Message -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); // Clear the message after displaying ?>
    <?php endif; ?>

    <!-- Movie Search
    <form method="GET" action="movie_management.php" class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search for a movie" value="<?php echo $searchTerm; ?>">
        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
      </div>
    </form> -->

    <!-- Add Movie Button -->
    <div class="text-center mb-4">
      <a href="add_movie.php" class="btn btn-primary">Add New Movie</a>
    </div>

    <!-- Edit Movie Button (Dropdown) -->
    <div class="mb-4 text-center">
        <h4 class="fw-bold">Edit Movie</h4>
        <form method="GET" action="edit_movie.php">
            <div class="input-group">
                <select class="form-select" name="movie_id" required>
                    <option value="">Select Movie to Edit</option>
                    <?php foreach ($movies as $movie): ?>
                        <option value="<?php echo $movie['movie_id']; ?>"><?php echo $movie['title']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-outline-light" type="submit">Edit</button>
            </div>
        </form>
    </div>

    <!-- Movies List -->
    <div class="row g-3 mb-4">
      <?php if (count($movies) > 0): ?>
        <?php foreach ($movies as $movie): ?>
          <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
              <img src="<?php echo $movie['poster_image_url']; ?>" alt="<?php echo $movie['title']; ?>" class="card-img-top" />
              <div class="card-body">
                <h5 class="card-title"><?php echo $movie['title']; ?></h5>
                <p class="card-text"><?php echo substr($movie['description'], 0, 100) . '...'; ?></p>
                <a href="movie_details.php?movie_id=<?php echo $movie['movie_id']; ?>" class="btn btn-light">View Details</a>
                <a href="movie_management.php?delete=<?php echo $movie['movie_id']; ?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No movies found.</p>
      <?php endif; ?>
    </div>
  </main>

  <!-- Footer -->
  <?php require 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
