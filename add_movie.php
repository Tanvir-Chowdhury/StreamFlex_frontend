<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Movie - StreamFlex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/brand.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body style="background-color: var(--bg-primary); color: var(--text-primary)">
  <?php require 'navbar.php'; ?>

  <main class="d-flex align-items-center justify-content-center flex-grow-1 p-3" style="min-height: 100vh;">
    <div class="form-container shadow-lg mx-auto" style="background: var(--bg-secondary); border-radius: 1rem; min-width:320px; max-width:550px;">
      <div class="text-center mb-4">
        <h1 class="h3 fw-bold" style="letter-spacing: 1px; color: var(--brand-main);">
          <i class="bi bi-film"></i> Add New Movie
        </h1>
        <div style="height: 3.5px; background: var(--gradient-brand-primary); border-radius: 99px; width: 56px; margin: 0 auto 28px auto;"></div>
      </div>

      <!-- OMDb Search Form -->
      <form id="searchForm" class="mb-4">
        <div class="row g-2">
          <div class="col-7">
            <input type="text" id="searchTitle" class="form-control" placeholder="Movie Title (e.g. Jawan)" />
          </div>
          <div class="col-3">
            <input type="number" id="searchYear" class="form-control" placeholder="Year" />
          </div>
          <div class="col-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-search">Search</i>
            </button>
          </div>
        </div>
      </form>

      <div id="searchResults" class="mb-3"></div>

      <!-- Actual Movie Form -->
      <form action="upload_movie.php" method="POST" id="movieForm" autocomplete="off">
        <div class="row g-3">
          <div class="col-12 col-md-7">
            <label for="title" class="form-label visually-hidden">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required />
          </div>
          <div class="col-6 col-md-5">
            <label for="genre" class="form-label visually-hidden">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre" required />
          </div>
          <div class="col-6 col-md-5">
            <label for="rating" class="form-label visually-hidden">Rating (IMDb)</label>
            <input type="number" step="0.1" class="form-control" id="rating" name="rating" placeholder="Rating" required />
          </div>
          <div class="col-6 col-md-7">
            <label for="language" class="form-label visually-hidden">Language</label>
            <input type="text" class="form-control" id="language" name="language" placeholder="Language" required />
          </div>
          <div class="col-12">
            <label for="description" class="form-label visually-hidden">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Short Description" rows="2" required></textarea>
          </div>
          <div class="col-6 col-md-6">
            <label for="release_year" class="form-label visually-hidden">Release Year</label>
            <input type="number" class="form-control" id="release_year" name="release_year" placeholder="Release Year" required />
          </div>
          <div class="col-6 col-md-6">
            <label for="price" class="form-label visually-hidden">Price (৳)</label>
            <input type="number" class="form-control" id="price" name="price" step="10" placeholder="Price" required />
          </div>
          <div class="col-12 col-md-6">
            <label for="trailer_url" class="form-label visually-hidden">Trailer URL</label>
            <input type="url" class="form-control" id="trailer_url" name="trailer_url" placeholder="Trailer URL" />
          </div>
          <div class="col-12 col-md-6">
            <label for="imdb_url" class="form-label visually-hidden">IMDb URL</label>
            <input type="url" class="form-control" id="imdb_url" name="imdb_url" placeholder="IMDb URL" />
          </div>
          <div class="col-12 col-md-6">
            <label for="tmdb_url" class="form-label visually-hidden">TMDB URL</label>
            <input type="url" class="form-control" id="tmdb_url" name="tmdb_url" placeholder="TMDB URL" />
          </div>
          <div class="col-12 col-md-6">
            <label for="movie_file_url" class="form-label visually-hidden">Movie File URL</label>
            <input type="url" class="form-control" id="movie_file_url" name="movie_file_url" placeholder="Movie File URL" required />
          </div>
          <div class="col-12">
            <label for="poster_image_url" class="form-label visually-hidden">Poster Image URL</label>
            <input type="url" class="form-control" id="poster_image_url" name="poster_image_url" placeholder="Poster Image URL" required />
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">
          <i class="bi bi-cloud-upload"></i> Add Movie
        </button>
      </form>
    </div>
  </main>
  <?php require 'footer.php'; ?>

  <!-- Load and inject API keys before using -->
  <script>
    let OMDB_API_KEY = "";
    let TMDB_API_KEY = "";
    let YOUTUBE_API_KEY = "";

    async function loadApiKeys() {
      const res = await fetch("api/get_api_keys.php");
      const keys = await res.json();
      OMDB_API_KEY = keys.omdb;
      TMDB_API_KEY = keys.tmdb;
      YOUTUBE_API_KEY = keys.youtube;
    }
    loadApiKeys();
  </script>

  <script src="js/add_movie.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>

</body>

</html>