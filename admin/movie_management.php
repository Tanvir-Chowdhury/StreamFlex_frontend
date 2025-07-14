<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movie Management</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />


    <link rel="stylesheet" href="../css/brand.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="css/movie_management.css" />

  </head>
  <body>
    <!-- Navbar -->
    <?php require '../navbar.php'; ?>

    <div class="container py-5 mt-5">
      <h2 class="mb-4 fw-bold">Movie Management</h2>

      <!-- Upload Form -->
      <div class="form-section">
        <h4 class="mb-3">Upload New Movie</h4>
        <form id="movieForm" action="upload_movie.php" method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="title" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Poster Link</label>
              <input type="url" class="form-control" id="imdb" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Video Embed URL</label>
              <input type="url" class="form-control" id="video" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Trailer Link</label>
              <input type="url" class="form-control" id="trailer" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Language</label>
              <select class="form-select" id="language" required>
                <option value="">Select Language</option>
                <option value="English">English</option>
                <option value="Bangla">Bangla</option>
                <option value="Hindi">Hindi</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Genre</label>
              <select class="form-select" id="genre" required>
                <option value="">Select Genre</option>
                <option value="Action">Action</option>
                <option value="Drama">Drama</option>
                <option value="Thriller">Thriller</option>
                <option value="Comedy">Comedy</option>
                <option value="Romance">Romance</option>
                <option value="Adventure">Adventure</option>
                <option value="Crime">Crime</option>
                <option value="Sci-Fi">Sci-Fi</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Rating</label>
              <input step="any" type="number" class="form-control" id="rating" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Year</label>
              <input type="text" class="form-control" id="year" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Price</label>
              <input type="number" class="form-control" id="price" required />
            </div>
            <div class="col-12">
              <label class="form-label">Details / Description</label>
              <textarea
                class="form-control"
                id="details"
                rows="3"
                required
              ></textarea>
            </div>
          </div>
          <button
            style="background: var(--gradient-brand-primary); border: 0"
            type="submit"
            class="btn btn-primary mt-3"
          >
            Upload
          </button>
        </form>
      </div>

      <!-- movie list -->
      <h4 class="mb-3">Movie List</h4>
      <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover align-middle">
          <thead class="table-dark text-white">
            <tr>
              <th>IMDB</th>
              <th>Video</th>
              <th>Trailer</th>
              <th>Language</th>
              <th>Genre</th>
              <th>Details</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="movieTableBody"></tbody>
        </table>
      </div>
    </div>

    <!-- Footer -->
    <?php require '../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/movie_management.js"></script>

  </body>
</html>
