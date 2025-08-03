<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Movie - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/brand.css" />
</head>
<body style="background-color: var(--bg-primary); color: var(--text-primary)">
  <?php require 'navbar.php'; ?>

  <main class="container" style="padding-top: 100px">
    <h2 class="mb-4 fw-bold">Add New Movie</h2>

    <!-- Search Form -->
    <div class="row mb-3">
      <div class="col-md-5">
        <input type="text" id="searchTitle" class="form-control" placeholder="Movie Title (e.g. Jawan)" />
      </div>
      <div class="col-md-3">
        <input type="number" id="searchYear" class="form-control" placeholder="Year (e.g. 2023)" />
      </div>
      <div class="col-md-4">
        <button class="btn btn-secondary w-100" onclick="searchMovies()">Search via OMDb</button>
      </div>
    </div>

    <!-- OMDb Search Results -->
    <div id="searchResults" class="mb-4"></div>

    <!-- Movie Form -->
    <form action="upload_movie.php" method="POST" id="movieForm">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required />
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" required />
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating (IMDb)</label>
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

  <?php require 'footer.php'; ?>
  <script src="js/add_movie.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
