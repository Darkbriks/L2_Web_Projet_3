<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $GLOBALS['CURRENT_LANGUAGE'] . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

if (isset($_POST['id']))
{
    try { $moviesDB = new MoviesDB(); }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    if (isset($_POST['seen']))
    {
        try
        {
            $seen = $_POST['seen'] === 'true' ? 1 : 0;
            $moviesDB->setSeen(htmlspecialchars($_POST['id']), $seen);
            echo json_encode(['success' => true, 'data' => $GLOBALS['api-set-seen-success']]);
        }
        catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
    }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-set-seen-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-set-seen-error-1']]); }