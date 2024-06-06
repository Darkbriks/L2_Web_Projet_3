<?php

use mdb\MoviesDB;

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { json_encode(['success' => false, 'error' => 'You must be an admin to access this page']); exit(); }

$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

try { $moviesDB = new MoviesDB(); }
catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

if (isset($_POST['addLink']) && isset($_POST['movieId']) && isset($_POST['personId']) && isset($_POST['personType']) && isset($_POST['personRole']))
{
    $movieId = (int)htmlspecialchars($_POST['movieId']);
    $personId = (int)htmlspecialchars($_POST['personId']);
    $personType = htmlspecialchars($_POST['personType']);
    $personRole = htmlspecialchars($_POST['personRole']);

    try
    {
        $moviesDB->addLink($movieId, $personId, $personType, $personRole);
        echo json_encode(['success' => true, 'data' => 'Person added to movie']);
    }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
}
else if (isset($_POST['removeLink']) && isset($_POST['movieId']) && isset($_POST['personId']))
{
    $movieId = (int)htmlspecialchars($_POST['movieId']);
    $personId = (int)htmlspecialchars($_POST['personId']);

    try
    {
        $moviesDB->breakLink($movieId, $personId);
        echo json_encode(['success' => true, 'data' => 'Person removed from movie']);
    }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
}
else { echo json_encode(['success' => false, 'error' => 'Missing parameters']); }