<?php
include 'connection.php';

// Enable error reporting (for development only)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $title = trim($_POST['title'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $rating = floatval($_POST['rating'] ?? 0);
    $language = trim($_POST['language'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $release_year = intval($_POST['release_year'] ?? 0);
    $price = floatval($_POST['price'] ?? 0);
    $trailer_url = trim($_POST['trailer_url'] ?? '');
    $imdb_url = trim($_POST['imdb_url'] ?? '');
    $tmdb_url = trim($_POST['tmdb_url'] ?? '');
    $movie_file_url = trim($_POST['movie_file_url'] ?? '');
    $poster_image_url = trim($_POST['poster_image_url'] ?? '');

    // Temporary static uploader (admin user_id = 1)
    $uploaded_by = 1;
    $created_at = date('Y-m-d H:i:s');

    // SQL query with matching column order
    $sql = "INSERT INTO movies (
        title, genre, rating, language, description, release_year,
        price, trailer_url, imdb_url, tmdb_url, movie_file_url,
        poster_image_url, uploaded_by, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("<p style='color: red;'>Prepare failed: " . $conn->error . "</p>");
    }

    // Correct order of bind_param values (match table)
// title, genre, rating, language, description, release_year, price, trailer_url, imdb_url, tmdb_url, movie_file_url, poster_image_url, uploaded_by, created_at
$stmt->bind_param(
    "sssssdssssssis",  // 
    $title,            // s
    $genre,            // s
    $rating,           // d
    $language,         // s
    $description,      // s
    $release_year,     // d
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
        echo "<p style='color: green;'>Movie uploaded successfully.</p>";
        header("Location: movie_management.php");
        exit;
    } else {
        echo "<p style='color: red;'>Execute failed: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color: orange;'>Please submit the form first.</p>";
}
?>
