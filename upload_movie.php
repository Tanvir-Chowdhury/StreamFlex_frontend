<?php
include 'connection.php';

// Optional: Enable error reporting for development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Collect and sanitize form inputs
                $title = trim($_POST['title'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $release_year = trim($_POST['release_year'] ?? '');
                $price = floatval($_POST['price'] ?? 0);
                $trailer_url = trim($_POST['trailer_url'] ?? '');
                $imdb_url = trim($_POST['imdb_url'] ?? '');
                $tmdb_url = ''; // Optional or set if you add this field later
                $movie_file_url = trim($_POST['movie_file_url'] ?? '');
                $poster_image_url = $imdb_url; // Using IMDb link as poster
                $uploaded_by = 'admin'; // Or use session: $_SESSION['username']
                $created_at = date('Y-m-d H:i:s');
                $genre = trim($_POST['genre'] ?? '');
                $rating = floatval($_POST['rating'] ?? 0);
                $language = trim($_POST['language'] ?? '');

                // Prepare SQL
                $sql = "INSERT INTO movies (
                                `title`, `description`, `release_year`, `price`, `trailer_url`, `imdb_url`, `tmdb_url`, `movie_file_url`, `poster_image_url`, `uploaded_by`, `created_at`, `genre`, `rating`, `language`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param(
                                "sssdsdssssssds",
                                $title,
                                $description,
                                $release_year,
                                $price,
                                $trailer_url,
                                $imdb_url,
                                $tmdb_url,
                                $movie_file_url,
                                $poster_image_url,
                                $uploaded_by,
                                $created_at,
                                $genre,
                                $rating,
                                $language
                );

                if ($stmt->execute()) {
                                echo "<p style='color: green;'>Movie uploaded successfully.</p>";
                                header("Location: admin/movie_management.php");
exit;
                } else {
                                echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }
} else {
                echo "<p style='color: orange;'>Please submit the form first.</p>";
}
?>
