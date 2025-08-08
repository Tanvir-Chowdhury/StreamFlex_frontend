<?php
include 'connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $title            = trim($_POST['title'] ?? '');
    $genre            = trim($_POST['genre'] ?? '');
    $rating           = floatval($_POST['rating'] ?? 0);
    $language         = trim($_POST['language'] ?? '');
    $description      = trim($_POST['description'] ?? '');
    $release_year     = intval($_POST['release_year'] ?? 0);
    $price            = floatval($_POST['price'] ?? 0);
    $trailer_url      = trim($_POST['trailer_url'] ?? '');
    $imdb_url         = trim($_POST['imdb_url'] ?? '');
    $tmdb_url         = trim($_POST['tmdb_url'] ?? '');
    $movie_file_url   = trim($_POST['movie_file_url'] ?? '');
    $poster_image_url = trim($_POST['poster_image_url'] ?? '');

    // Validate that trailer_url is a YouTube embed URL
    if (!preg_match('#^https://www\.youtube\.com/embed/[\w\-]+$#', $trailer_url)) {
        die("<p style='color: red;'>Invalid trailer URL! Please enter a valid YouTube embed link.</p>");
    }

    // Additional optional checks (e.g., required fields)
    if (empty($title) || empty($genre) || empty($release_year) || empty($movie_file_url) || empty($poster_image_url)) {
        die("<p style='color: red;'>Please fill all required fields.</p>");
    }

    $uploaded_by = 1; // static admin uploader for now
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO movies (
        title, genre, rating, language, description, release_year,
        price, trailer_url, imdb_url, tmdb_url, movie_file_url,
        poster_image_url, uploaded_by, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("<p style='color: red;'>Prepare failed: " . htmlspecialchars($conn->error) . "</p>");
    }

    // "ssdssdsisssis"
   $stmt->bind_param(
    "ssdssidsssssis",
    $title,            // s
    $genre,            // s
    $rating,           // d
    $language,         // s
    $description,      // s
    $release_year,     // i
    $price,            // d
    $trailer_url,      // s
    $imdb_url,         // s
    $tmdb_url,         // s
    $movie_file_url,   // s
    $poster_image_url, // s
    $uploaded_by,      // i
    $created_at        // s
);

    if ($stmt->execute()) {
        // Success!
        header("Location: movie_management.php?msg=success");
        exit;
    } else {
        echo "<p style='color: red;'>Execute failed: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color: orange;'>Please submit the form first.</p>";
}
?>
