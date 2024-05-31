<?php

use mdb\PersonDB;

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

error_reporting(0);

$person = trim($_POST['person']);

$personDB = new PersonDB();
$persons = $personDB->getPersons();

foreach ($persons as $index => $p)
{
    if ($p->getFirstName() . ' ' . $p->getLastName() === $person)
    {
        $person = $p;
        echo json_encode(['success' => true, 'data' => json_encode($person->get_json())]);
        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Person not found']);
?>