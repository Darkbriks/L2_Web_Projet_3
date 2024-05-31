<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

$moviesDB = new MoviesDB();
if ($_POST['tagId'] == -1) { $movies = $moviesDB->getMovies(); }
else { $movies = $moviesDB->getMoviesByTag($_POST['tagId']); }

$json_movies = json_encode(array_map(function($movie) { return $movie->get_movieCard(); }, $movies));
echo json_encode(['success' => true, 'data' => $json_movies]);
?>