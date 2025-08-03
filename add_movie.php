<?php
include 'connection.php';

//  form submission add movie
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $rating = (float)$_POST['rating'];
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $release_year = (int)$_POST['release_year'];
    $price = (float)$_POST['price'];
    $trailer_url = mysqli_real_escape_string($conn, $_POST['trailer_url']);
    $imdb_url = mysqli_real_escape_string($conn, $_POST['imdb_url']);
    $tmdb_url = mysqli_real_escape_string($conn, $_POST['tmdb_url']);
    $movie_file_url = mysqli_real_escape_string($conn, $_POST['movie_file_url']);
    $poster_image_url = mysqli_real_escape_string($conn, $_POST['poster_image_url']);
    $uploaded_by = 1; // Assuming the admin ID is 1

    $query = "INSERT INTO movies (title, genre, rating, language, description, release_year, price, trailer_url, imdb_url, tmdb_url, movie_file_url, poster_image_url, uploaded_by) 
              VALUES ('$title', '$genre', $rating, '$language', '$description', $release_year, $price, '$trailer_url', '$imdb_url', '$tmdb_url', '$movie_file_url', '$poster_image_url', $uploaded_by)";

    if (mysqli_query($conn, $query)) {
        echo "<p>Movie added successfully!</p>";
    } else {
        echo "<p>Error adding movie: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Movie - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="preload" as="stylesheet" />
  <link rel="preload" as="stylesheet" href="css/navbar.css" />
  <link rel="preload" as="stylesheet" href="css/brand.css" />
</head>
<body style="background-color: var(--bg-primary); color: var(--text-primary)">
  <!-- Navbar -->
  <?php require 'navbar.php'; ?>

  <!-- Add Movie Form -->
  <main class="container" style="padding-top: 100px">
    <h2 class="mb-4 fw-bold">Add New Movie</h2>

    <form action="add_movie.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required />
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" required />
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" step="0.1" required />
      </div>
      <div class="mb-3">
        <label for="language" class="form-label">Language</label>
        <input type="text" class="form-control" id="language" name="language" required />
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="release_year" class="form-label">Release Year</label>
        <input type="number" class="form-control" id="release_year" name="release_year" required />
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required />
      </div>
      <div class="mb-3">
        <label for="trailer_url" class="form-label">Trailer URL</label>
        <input type="url" class="form-control" id="trailer_url" name="trailer_url" />
      </div>
      <div class="mb-3">
        <label for="imdb_url" class="form-label">IMDB URL</label>
        <input type="url" class="form-control" id="imdb_url" name="imdb_url" />
      </div>
      <div class="mb-3">
        <label for="tmdb_url" class="form-label">TMDB URL</label>
        <input type="url" class="form-control" id="tmdb_url" name="tmdb_url" />
      </div>
      <div class="mb-3">
        <label for="movie_file_url" class="form-label">Movie File URL</label>
        <input type="url" class="form-control" id="movie_file_url" name="movie_file_url" required />
      </div>
      <div class="mb-3">
        <label for="poster_image_url" class="form-label">Poster Image URL</label>
        <input type="url" class="form-control" id="poster_image_url" name="poster_image_url" required />
      </div>

      <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>
  </main>

  <!-- Footer -->
  <?php require 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
