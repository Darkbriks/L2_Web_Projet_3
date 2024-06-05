<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

try {
    $moviesDB = new MoviesDB();
    $movies = $moviesDB->getMovies();

    // Mélanger les films de manière aléatoire
    shuffle($movies);

    // Sélectionner les 4 premiers films
    $randomMovies = array_slice($movies, 0, 4);

    $json_movies = json_encode(array_map(function($movie) { return $movie->get_json(); }, $randomMovies));
    echo json_encode(['success' => true, 'data' => $json_movies]);
}
catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit();
}
?>
