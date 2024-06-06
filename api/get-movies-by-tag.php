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

if (isset($_POST['tagId']))
{
    try
    {
        $moviesDB = new MoviesDB();
        if ($_POST['tagId'] == -1) { $movies = $moviesDB->getMovies(); }
        else { $movies = $moviesDB->getMoviesByTag(htmlspecialchars($_POST['tagId'])); }
    }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    $json_movies = json_encode(array_map(function($movie) { return $movie->get_json(); }, $movies));
    echo json_encode(['success' => true, 'data' => $json_movies]);
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-movies-by-tag-error-1']]); }
?>
