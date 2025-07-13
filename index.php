
<?php

include 'connection.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>StreamFlex - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />

  <link rel="stylesheet" href="css/navbar.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/brand.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>

<body style="background-color: var(--bg-primary)">
  <!-- Navbar -->
   <?php require 'navbar.php';?>
  

  <!-- Hero Section -->
  <section class="position-relative min-vh-100 h-auto py-5 d-flex align-items-center text-white overflow-hidden">
    <!-- Background Image -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="
          background: url('https://image.tmdb.org/t/p/original/m2D0kUDwBury5uBRHhFCu8Oz5MM.jpg') no-repeat center center;
          background-size: cover;
          z-index: 1;
        "></div>

    <!-- Gradient Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: var(--gradient-hero); z-index: 2"></div>

    <!-- Content -->
    <div style="width: 80%" class="container position-relative z-3">
      <div class="col-md-8">
        <h1 class="display-3 fw-bold mb-4">Jurassic World Rebirth</h1>
        <p class="lead text-light mb-4">
          An expedition braves isolated equatorial regions to extract DNA from three massive prehistoric creatures for a groundbreaking medical breakthrough.
        </p>

        <div class="d-flex gap-4 text-light mb-4">
          <div class="d-flex align-items-center gap-2">
            <i style="color: var(--gold)" class="bi bi-star-fill"></i>
            <span class="fw-semibold">6.2</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-calendar3"></i>
            <span>2025</span>
          </div>
        </div>

        <div class="d-flex gap-3">
          <a href="movie_details.php?movie_id=5" class="btn btn-light text-dark fw-semibold px-4 py-2 d-flex align-items-center gap-2">
            <i class="bi bi-play-fill"></i> Play Now
          </a>
          <a href="movie_details.php?movie_id=5"
            class="btn btn-secondary bg-opacity-75 text-white fw-semibold px-4 py-2 d-flex align-items-center gap-2">
            <i class="bi bi-info-circle"></i> More Info
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Trending Movies -->
  <div style="width: 80%" class="container-fluid mt-5">
    <div class="container-header">
      <h2 class="fw-bold text-sm-center pb-2">Trending Movies</h2>
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

  <!-- Pricing -->
  <div style="background-color: var(--bg-secondary)" class="mt-5">
    <div style="width: 80%" class="container py-5 text-center text-white">
      <h2 class="fw-bold mb-2">Choose Your Plan</h2>
      <p style="color: var(--text-secondary)" class="mb-4">
        Unlimited movies and series, cancel anytime
      </p>

      <div class="d-flex justify-content-center align-items-center mb-5">
        <span class="me-2">Monthly</span>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="billingToggle" />
        </div>
        <span style="color: var(--success)" class="ms-2">Yearly <small>(Save 20%)</small></span>
      </div>

      <div class="row justify-content-center">
        <!-- Basic Plan -->
        <div class="col-md-4 mb-4">
          <div style="background-color: var(--bg-primary)" class="card text-white h-100">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title fw-bold">Basic</h5>
                <div class="d-flex justify-content-center align-items-baseline">
                  <div>
                    <h2 id="price-basic" class="fw-bold">280 Tk</h2>
                  </div>
                  <div>
                    <h2 style="color: var(--text-tertiary)" class="price-text fs-6">
                      /month
                    </h2>
                  </div>
                </div>
                <ul class="list mt-3 mb-4 text-start">
                  <li>HD Quality</li>
                  <li>2 Devices</li>
                  <li>Limited Selection</li>
                  <li>Mobile & Tablet</li>
                </ul>
              </div>
              <div>
                <a href="#" class="btn btn-secondary w-100">Get Started</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Standard Plan -->
        <div class="col-md-4 mb-4">
          <div style="
                background-color: var(--bg-primary);
                border-color: var(--brand-purple);
              " class="card border-2 text-white h-100">
            <div class="card-body position-relative d-flex flex-column justify-content-between">
              <div>
                <span style="background: var(--gradient-brand-primary)"
                  class="badge position-absolute top-0 start-50 translate-middle rounded-pill">Most Popular</span>
                <h5 class="card-title fw-bold mt-2">Standard</h5>
                <div class="d-flex justify-content-center align-items-baseline">
                  <div>
                    <h2 id="price-standard" class="fw-bold">340 Tk</h2>
                  </div>
                  <div>
                    <h2 style="color: var(--text-tertiary)" class="price-text fs-6">
                      /month
                    </h2>
                  </div>
                </div>
                <ul class="list mt-3 mb-4 text-start">
                  <li>Full HD Quality</li>
                  <li>4 Devices</li>
                  <li>Full Library</li>
                  <li>All Devices</li>
                  <li>Download Offline</li>
                </ul>
              </div>
              <div>
                <a id="standard-btn" style="background: var(--gradient-brand-primary); border: 0" href="#"
                  class="btn btn-primary w-100">Get Started</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Premium Plan -->
        <div class="col-md-4 mb-4">
          <div style="background-color: var(--bg-primary)" class="card text-white h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Premium</h5>
              <div class="d-flex justify-content-center align-items-baseline">
                <div>
                  <h2 id="price-premium" class="fw-bold">510 Tk</h2>
                </div>
                <div>
                  <h2 style="color: var(--text-tertiary)" class="price-text fs-6">
                    /month
                  </h2>
                </div>
              </div>

              <ul class="list mt-3 mb-4 text-start">
                <li>4K Ultra HD</li>
                <li>6 Devices</li>
                <li>Early Access</li>
                <li>All Devices</li>
                <li>Download Offline</li>
                <li>Family Profiles</li>
              </ul>
              <a href="#" class="btn btn-secondary w-100">Get Started</a>
            </div>
          </div>
        </div>
      </div>

      <p style="color: var(--text-secondary)" class="mt-3">
        Or rent individual movies starting from 20 Tk
      </p>
    </div>
  </div>

  <!-- Footer -->
  <?php require 'footer.php'; ?>

  <script src="js/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
</body>

</html>