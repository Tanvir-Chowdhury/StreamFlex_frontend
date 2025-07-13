<nav style="background-color: var(--bg-primary)" class="navbar navbar-expand-lg fixed-top py-2">
    <div style="width: 80%" class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="index.html">
            Stream<span style="color: var(--brand-purple)">Flex</span>
        </a>

        <!-- mobile menu -->
        <button class="navbar-toggler navbar-dark text-white border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarlinks">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- links -->
        <div class="collapse navbar-collapse" id="navbarlinks">
            <ul class="navbar-nav me-auto ms-3">
                <li class="nav-item">
                    <a style="color: var(--text-tertiary)" class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a style="color: var(--text-tertiary)" class="nav-link" href="movies.php">Movies</a>
                </li>
                <li class="nav-item">
                    <a style="color: var(--text-tertiary)" class="nav-link" href="subscription.php">Subscription</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <!-- Search Input -->
                <div class="position-relative">
                    <form style="background-color: var(--bg-tertiary);"
                        class="d-flex align-items-center px-3 rounded-pill" style="min-width: 250px">
                        <i style="color: var(--text-tertiary)" class="bi bi-search me-2"></i>
                        <input id="search" class="form-control border-0 bg-transparent text-white"
                            type="search" placeholder="Search movies..." aria-label="Search">
                        </form>
                    <div style="z-index: 10000;" id="suggestionsContainer"
                        class="position-absolute w-100 mt-1 bg-white text-dark rounded shadow"></div>
                </div>



                <!-- User Icon -->
                <div class="ms-3">
                    <i style="color: var(--text-tertiary)" class="bi bi-person fs-5"></i>
                </div>
            </div>
        </div>
    </div>
</nav>

<script src="js/navbar.js"></script>