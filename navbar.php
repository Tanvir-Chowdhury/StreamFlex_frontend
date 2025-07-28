<nav style="background-color: var(--bg-primary)" class="navbar navbar-expand-lg fixed-top py-2">
    <div style="width: 80%" class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="index.php">
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
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                if (isset($_SESSION['user_id'])) {
                    include 'connection.php';
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT r.role_name AS role_name 
              FROM users u
              JOIN roles r ON u.role_id = r.role_id
              WHERE u.user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();

                    if ($user) {
                        $role = strtolower($user['role_name']);
                        if ($role !== 'admin') {
                            echo '<li class="nav-item">
                    <a style="color: var(--text-tertiary)" class="nav-link" href="cart.php">Cart</a>
                </li>';
                        }
                    }

                    $stmt->close();
                    $conn->close();
                }
                ?>

            </ul>

            <div class="d-flex align-items-center">
                <!-- Search Input -->
                <div class="position-relative">
                    <form style="background-color: var(--bg-tertiary);"
                        class="d-flex align-items-center px-3 rounded-pill" style="min-width: 250px">
                        <i style="color: var(--text-tertiary)" class="bi bi-search me-2"></i>
                        <input id="search" class="form-control border-0 bg-transparent text-white" type="search"
                            placeholder="Search movies..." aria-label="Search">
                    </form>
                    <div style="z-index: 10000;" id="suggestionsContainer"
                        class="position-absolute w-100 mt-1 bg-white text-dark rounded shadow"></div>
                </div>



                <!-- User Icon -->
                <div class="ms-3">
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (!isset($_SESSION['user_id'])) {
                        echo '<a href="login.php"><i style="color: var(--text-tertiary)" class="bi bi-person fs-5"></i></a>';
                    } else {
                        include 'connection.php';

                        $user_id = $_SESSION['user_id'];

                        $query = "SELECT r.role_name AS role_name 
              FROM users u
              JOIN roles r ON u.role_id = r.role_id
              WHERE u.user_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();

                        if ($user) {
                            $role = strtolower($user['role_name']);
                            $target = ($role === 'admin') ? 'admin_dashboard.php' : 'user_dashboard.php';
                            echo '<a href="' . $target . '"><i style="color: var(--text-tertiary)" class="bi bi-person fs-5"></i></a>';
                        } else {
                            echo '<a href="login.php"><i style="color: var(--text-tertiary)" class="bi bi-person fs-5"></i></a>';
                        }

                        $stmt->close();
                        $conn->close();
                    }
                    ?>
                </div>


            </div>
        </div>
    </div>
</nav>

<script src="js/navbar.js"></script>
<script>
    const movies = <?php echo $javascript_movie_array; ?>;
    const movieTitles = movies.map(movie => movie.title);
</script>