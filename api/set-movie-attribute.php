<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { echo $GLOBALS['admin-error']; exit(); }

$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

try { $moviesDB = new MoviesDB(); }
catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

if (isset($_POST['id']) && isset($_POST['attribute']) && isset($_POST['value']))
{
    $id = (int)htmlspecialchars($_POST['id']);
    $attribute = htmlspecialchars($_POST['attribute']);
    $value = htmlspecialchars($_POST['value']);

    if ($attribute === 'title' || $attribute === 'release_date' || $attribute === 'synopsis' || $attribute === 'image_path' || $attribute === 'time_duration' || $attribute === 'note' || $attribute === 'trailer_path' || $attribute === 'rating')
    {
        try
        {
            $moviesDB->setMovieAttribute($id, $attribute, $value);
            echo json_encode(['success' => true, 'data' => 'Attribute ' . $attribute . ' set for movie with id ']);
        }
        catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
    }
    else { echo json_encode(['success' => false, 'error' => 'Attribute must be title, release_date, synopsis, image-path, time duration, note, trailer_path, rating']); }
}
else { echo json_encode(['success' => false, 'error' => 'Missing parameters']); }