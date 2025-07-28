<?php

ob_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "streamflex";


$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());  
    exit();  
}

$sql = "SELECT `movie_id`, `title`, `description`, `release_year`, `price`, `trailer_url`,`imdb_url`, `tmdb_url`, `movie_file_url`, `poster_image_url`, `uploaded_by`, `created_at`, `genre`, `rating`, `language` FROM `movies`"; 

$sql_total_user = "SELECT COUNT(*) AS user_count FROM users";
$sql_total_subscribers = "SELECT COUNT(*) AS subscriber_count FROM subscriptions";
$sql_total_purchases = "SELECT COUNT(*) AS purchase_count FROM purchases";

$result = $conn->query($sql);
$result_total_user = $conn->query($sql_total_user);
$result_total_subscribers = $conn->query($sql_total_subscribers);
$result_total_purchases = $conn->query($sql_total_purchases);

$movie_array = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $movie_array[] = $row;
    }
} else {
    // No movies found
}

if ($result_total_user && $row = $result_total_user->fetch_assoc()) {
    $userCount = (int)$row['user_count'];
} else {
    $userCount = 0;
}

if ($result_total_subscribers && $row = $result_total_subscribers->fetch_assoc()) {
    $subscriberCount = (int)$row['subscriber_count'];
} else {
    $subscriberCount = 0; 
}

if ($result_total_purchases && $row = $result_total_purchases->fetch_assoc()) {
    $purchaseCount = (int)$row['purchase_count'];
} else {
    $purchaseCount = 0; 
}

$javascript_movie_array = json_encode($movie_array);

ob_end_clean();


