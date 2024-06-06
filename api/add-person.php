<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\PersonDB;

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_date']))
{
    try { $personDB = new PersonDB(); }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $death_date = isset($_POST['death_date']) ? htmlspecialchars($_POST['death_date']) : null;
    // TODO: add image upload and save to server, use PersonForm::createPerson

    try
    {
        $id = $personDB->addPersonAndReturnId($first_name, $last_name, $birth_date, $death_date, "un chemin d'image");
        echo json_encode(['success' => true, 'id' => $id, 'first_name' => $first_name, 'last_name' => $last_name, 'birth_date' => $birth_date, 'death_date' => $death_date]);
    }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); }
}
else { echo json_encode(['success' => false, 'error' => 'Missing parameters']); }