<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\PersonDB;

$personDB = new PersonDB();
$peoples = $personDB->getPersons();

$json_people = json_encode(array_map(function($movie) { return $movie->get_json(); }, $peoples));
echo json_encode(['success' => true, 'data' => $json_people]);
?>