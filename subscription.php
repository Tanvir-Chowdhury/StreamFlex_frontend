<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Subscription - StreamFlex</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/brand.css" />
    <link rel="stylesheet" href="css/series.css" />
    <link rel="stylesheet" href="css/navbar.css" />
  </head>
  <body>
    <!-- Navbar -->
    <?php require 'navbar.php';?>

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
            <input
              class="form-check-input"
              type="checkbox"
              id="billingToggle"
            />
          </div>
          <span style="color: var(--success)" class="ms-2"
            >Yearly <small>(Save 20%)</small></span
          >
        </div>

        <div class="row justify-content-center">
          <!-- Basic Plan -->
          <div class="col-md-4 mb-4">
            <div
              style="background-color: var(--bg-primary)"
              class="card text-white h-100"
            >
              <div class="card-body d-flex flex-column justify-content-between">
                <div>
                  <h5 class="card-title fw-bold">Basic</h5>
                  <div
                    class="d-flex justify-content-center align-items-baseline"
                  >
                    <div>
                      <h2 id="price-basic" class="fw-bold">280 Tk</h2>
                    </div>
                    <div>
                      <h2
                        style="color: var(--text-tertiary)"
                        class="price-text fs-6"
                      >
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
            <div
              style="
                background-color: var(--bg-primary);
                border-color: var(--brand-purple);
              "
              class="card border-2 text-white h-100"
            >
              <div
                class="card-body position-relative d-flex flex-column justify-content-between"
              >
                <div>
                  <span
                    style="background: var(--gradient-brand-primary)"
                    class="badge position-absolute top-0 start-50 translate-middle rounded-pill"
                    >Most Popular</span
                  >
                  <h5 class="card-title fw-bold mt-2">Standard</h5>
                  <div
                    class="d-flex justify-content-center align-items-baseline"
                  >
                    <div>
                      <h2 id="price-standard" class="fw-bold">340 Tk</h2>
                    </div>
                    <div>
                      <h2
                        style="color: var(--text-tertiary)"
                        class="price-text fs-6"
                      >
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
                  <a
                    id="standard-btn"
                    style="background: var(--gradient-brand-primary); border: 0"
                    href="#"
                    class="btn btn-primary w-100"
                    >Get Started</a
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Premium Plan -->
          <div class="col-md-4 mb-4">
            <div
              style="background-color: var(--bg-primary)"
              class="card text-white h-100"
            >
              <div class="card-body">
                <h5 class="card-title fw-bold">Premium</h5>
                <div class="d-flex justify-content-center align-items-baseline">
                  <div>
                    <h2 id="price-premium" class="fw-bold">510 Tk</h2>
                  </div>
                  <div>
                    <h2
                      style="color: var(--text-tertiary)"
                      class="price-text fs-6"
                    >
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
    <script src="js/subscription.js" defer></script>
  </body>
</html>
