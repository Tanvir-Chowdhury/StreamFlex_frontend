<?php
require '../config.php';

header('Content-Type: application/json');

echo json_encode([
  'omdb'    => $OMDB_API_KEY,
  'tmdb'    => $TMDB_API_KEY,
  'youtube' => $YOUTUBE_API_KEY
]);
