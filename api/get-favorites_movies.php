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

    try { $moviesDB = new MoviesDB(); }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    $favoritesMovies = $moviesDB->getFavoritesMovies();

    $json_movies = json_encode(array_map(function($movie) { return $movie->get_json(); }, $favoritesMovies));
    echo json_encode(['success' => true, 'data' => $json_movies]);
?>
