<?php
include 'connection.php';

if (isset($_POST['suggestion']) && !empty(trim($_POST['suggestion']))) {
    $suggestion = "%" . $_POST['suggestion'] . "%";

    $sql = "SELECT `movie_id`, `title` FROM `movies` WHERE `title` LIKE ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $suggestion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<ul class="list-group list-group-flush">';
        while ($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item suggestion-item" movie_id="' . $row['movie_id'] . '">' . htmlspecialchars($row['title']) . '</li>';
        }
        echo '</ul>';
    }
}

?>
