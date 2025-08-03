<?php
require '../config.php'; // Go up one level

header('Content-Type: application/json');

echo json_encode([
  'omdb' => $OMDB_API_KEY,
  'tmdb' => $TMDB_API_KEY
]);
