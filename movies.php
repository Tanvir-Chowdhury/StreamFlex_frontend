<?php

include 'connection.php';

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movies - StreamFlex</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="preload" as="stylesheet"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="preload" as="stylesheet"
    />

    <link rel="preload" as="stylesheet" href="css/brand.css" />
    <link rel="preload" as="stylesheet" href="css/movies.css" />
    <link rel="preload" as="stylesheet" href="css/navbar.css" />
  </head>
  <body>
    <!-- Navbar -->
    <?php require 'navbar.php';?>

    <div class="position-relative">
      <img
        src="images/movie-series-list.jpg"
        alt=""
        style="width: 100%; max-height: 350px; object-fit: cover"
      />

      <div
        class="position-absolute top-0 start-0 w-100 h-100"
        style="background: rgba(0, 0, 0, 0.6)"
      ></div>

      <div
        style="top: 60%"
        class="position-absolute start-50 translate-middle text-center text-white"
      >
        <h1 class="fw-bold">Explore Our Movie Collection</h1>
      </div>
    </div>

    <div style="padding-top: 50px" class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Movie Listing</h2>
        <select id="sortSelect" class="form-select w-auto filter-select">
          <option value="">Sort By</option>
          <option value="newest">Newest</option>
          <option value="alphabetical">Alphabetical</option>
        </select>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="position-relative">
          <input
            type="text"
            id="searchInput"
            class="form-control"
            placeholder="Search by name..."
            aria-label="Search"
          />
          <div style="z-index: 10000;" id="suggestionsContainer2"
                        class="position-absolute w-100 mt-1 bg-white text-dark rounded shadow"></div>
                        </div>

        </div>
        <div class="col-md-2">
          <select id="genreFilter" class="form-select filter-select">
            <option value="">Genre</option>
            <option value="Action">Action</option>
            <option value="Thriller">Thriller</option>
            <option value="Sports">Sports</option>
            <option value="Drama">Drama</option>
            <option value="Crime">Crime</option>
            <option value="Adventure">Adventure</option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="ratingFilter" class="form-select filter-select">
            <option value="">Rating</option>
            <option value="9">9+</option>
            <option value="8">8+</option>
            <option value="7">7+</option>
            <option value="6">6+</option>
            <option value="5">5+</option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="yearFilter" class="form-select filter-select">
            <option value="">Year</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="langFilter" class="form-select filter-select">
            <option value="">Language</option>
            <option value="English">English</option>
            <option value="Bangla">Bangla</option>
            <option value="Hindi">Hindi</option>
          </select>
        </div>
        <div class="col-md-1">
          <button class="btn btn-purple w-100" onclick="applyFilters()">
            Search
          </button>
        </div>
      </div>
      <div class="movie-wrapper">
        <div class="movie-container" id="movieList"></div>
      </div>

      <div class="text-center mt-4 mb-4">
        <button
          id="loadMoreBtn"
          class="btn btn-outline-light"
          onclick="loadMore()"
        >
          Load More
        </button>
      </div>
    </div>

     <!-- Footer -->
    <?php require 'footer.php'; ?>

    <script src="js/movies.js" defer></script>
    <script defer>
  const movies = <?php echo $javascript_movie_array; ?>;
  const movieTitles = movies.map(movie => movie.title);
</script> 
  </body>
</html>
