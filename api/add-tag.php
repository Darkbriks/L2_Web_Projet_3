<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\TagDB;

if (isset($_POST['tag']))
{
    try { $tagDB = new TagDB(); }
    catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }

    $id = $tagDB->addTag(htmlspecialchars($_POST['tag']));

    if ($id !== 0) { echo json_encode(['success' => true, 'id' => $id, 'name' => $_POST['tag']]); }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-add-tag-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-add-tag-error-1']]); }
?>