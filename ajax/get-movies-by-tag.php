<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $GLOBALS['CURRENT_LANGUAGE'] . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

/*try { $moviesDB = new MoviesDB(); }
catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

if ($_POST['tagId'] == -1) { $movies = $moviesDB->getMovies(); }
else { $movies = $moviesDB->getMoviesByTag($_POST['tagId']); }

$json_movies = json_encode(array_map(function($movie) { return $movie->get_json(); }, $movies));
echo json_encode(['success' => true, 'data' => $json_movies]);*/



if (isset($_POST['tagId']))
{
    try { $moviesDB = new MoviesDB(); }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    if ($_POST['tagId'] == -1) { $movies = $moviesDB->getMovies(); }
    else { $movies = $moviesDB->getMoviesByTag(htmlspecialchars($_POST['tagId'])); }

    $json_movies = json_encode(array_map(function($movie) { return $movie->get_json(); }, $movies));
    echo json_encode(['success' => true, 'data' => $json_movies]);
}
else { echo json_encode(['success' => false, 'error' => 'No tagID provided']); }
?>
