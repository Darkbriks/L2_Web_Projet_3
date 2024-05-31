<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\TagBD;

$tagDB = new TagBD();
$id = $tagDB->addTag($_POST['tag']);

if ($id !== 0) { echo json_encode(['success' => true, 'id' => $id, 'name' => $_POST['tag']]); }
else { echo json_encode(['success' => false]); }
?>