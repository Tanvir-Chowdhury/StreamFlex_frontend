<?php
include 'connection.php';

// Initialize variables
$movie = null;
$movieId = null;
$updateMessage = '';

// Check if a movie ID is passed for editing
if (isset($_GET['movie_id'])) {
    $movieId = (int)$_GET['movie_id'];

    // Fetch movie details
    $stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found!";
        exit;
    }
}

// Handle form submission to update movie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movie_id'])) {
    $movieId = $_POST['movie_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $language = $_POST['language'];
    $price = $_POST['price'];
    $poster_image_url = $_POST['poster_image_url'];
    $movie_file_url = $_POST['movie_file_url'];
    $trailer_url = $_POST['trailer_url'];

    // Update the movie details in the database
    $update_query = "UPDATE movies SET
                        title = ?, 
                        description = ?, 
                        genre = ?, 
                        rating = ?, 
                        language = ?, 
                        price = ?, 
                        poster_image_url = ?, 
                        movie_file_url = ?, 
                        trailer_url = ?
                    WHERE movie_id = ?";
    
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssssssi", $title, $description, $genre, $rating, $language, $price, $poster_image_url, $movie_file_url, $trailer_url, $movieId);

    if ($stmt->execute()) {
        $updateMessage = "Movie details updated successfully!";
        // Redirect to movie management page
        header("Location: movie_management.php");
        exit();
    } else {
        $updateMessage = "Error updating movie: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Movie - StreamFlex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="preload" as="stylesheet" />
    <link rel="preload" as="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="preload" as="stylesheet" href="css/brand.css" />
    <link rel="preload" as="stylesheet" href="css/navbar.css" />
</head>
<body style="background-color: var(--bg-primary); color: var(--text-primary)">
    <!-- Navbar -->
    <?php require 'navbar.php'; ?>

    <!-- Main Content -->
    <main class="container" style="padding-top: 100px">
        <h2 class="mb-4 fw-bold">Edit Movie Details</h2>

        <?php if ($movie): ?>
            <form method="POST" action="edit_movie.php">
                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Movie Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="4" required><?php echo htmlspecialchars($movie['description']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($movie['genre']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating" value="<?php echo htmlspecialchars($movie['rating']); ?>" step="0.1" min="0" max="10" required>
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                    <input type="text" class="form-control" name="language" value="<?php echo htmlspecialchars($movie['language']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (in Tk)</label>
                    <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($movie['price']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="poster_image_url" class="form-label">Poster Image URL</label>
                    <input type="text" class="form-control" name="poster_image_url" value="<?php echo htmlspecialchars($movie['poster_image_url']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="movie_file_url" class="form-label">Movie File URL</label>
                    <input type="text" class="form-control" name="movie_file_url" value="<?php echo htmlspecialchars($movie['movie_file_url']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="trailer_url" class="form-label">Trailer URL</label>
                    <input type="text" class="form-control" name="trailer_url" value="<?php echo htmlspecialchars($movie['trailer_url']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Movie</button>
            </form>

            <?php if ($updateMessage): ?>
                <div class="alert alert-success mt-4"><?php echo $updateMessage; ?></div>
            <?php endif; ?>

        <?php else: ?>
            <p>Movie not found.</p>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php require 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
