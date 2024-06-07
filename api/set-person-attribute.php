<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();

// TODO: localization
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { json_encode(['success' => false, 'error' => 'You must be an admin to access this page']); exit(); }

$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\PersonDB;

try { $personDB = new PersonDB(); }
catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

if (isset($_POST['id']) && isset($_POST['attribute']) && isset($_POST['value']))
{
    $id = (int)htmlspecialchars($_POST['id']);
    $attribute = htmlspecialchars($_POST['attribute']);
    $value = htmlspecialchars($_POST['value']);

    if ($attribute === 'first_name' || $attribute === 'last_name' || $attribute === 'birth_date' || $attribute === 'death_date' || $attribute === 'image_path')
    {
        try
        {
            $personDB->setPersonAttribute($id, $attribute, $value);
            echo json_encode(['success' => true, 'data' => 'Attribute ' . $attribute . ' set for this movie']);
        }
        catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
    }
    else { echo json_encode(['success' => false, 'error' => 'Attribute must be title, release_date, synopsis, image-path, time duration, note, trailer_path, rating']); }
}
else { echo json_encode(['success' => false, 'error' => 'Missing parameters']); }