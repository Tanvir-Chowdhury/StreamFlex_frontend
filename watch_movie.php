<?php
include 'connection.php';

if (isset($_GET['movie_id'])) {
    $movieId = intval($_GET['movie_id']);

    $stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found.";
        exit;
    }
} else {
    echo "No movie selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Watch Movie - StreamFlex</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/brand.css" />
    <link rel="stylesheet" href="css/navbar.css" />
   <!--<link rel="stylesheet" href="css/watch_movie.css" />-->
</head>
<body style="background-color: var(--bg-primary); color: var(--text-primary)">
    <!-- Navbar -->
    <?php require 'navbar.php'; ?>

    <!-- Main Content -->
    <main class="container" style="padding-top: 100px;">
        <div class="video-container mb-4">
            
            <div style="position: relative; padding-top: 56.25%">
            <iframe
                src="<?php echo htmlspecialchars($movie['movie_file_url']); ?>?autoplay=false&loop=false&muted=false&preload=true&responsive=true"
                loading="lazy"
                style="border: 0; position: absolute; top: 0; height: 100%; width: 100%"
                allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;"
                allowfullscreen="true"
            ></iframe>
        </div>

        </div>
        <div class="movie-details">
            <h2 class="fw-bold"><?php echo htmlspecialchars($movie['title']); ?></h2>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
            <p><strong>Rating:</strong> <?php echo htmlspecialchars($movie['rating']); ?></p>
            <p><strong>Language:</strong> <?php echo htmlspecialchars($movie['language']); ?></p>
        </div>
    </main>

    <!-- Footer -->
    <?php require 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
    <!--<script src="js/watch_movie.js" defer></script> age lagto ekhn dorkar nai ejonno comment out, moved to different JS -->
</body>
</html>
