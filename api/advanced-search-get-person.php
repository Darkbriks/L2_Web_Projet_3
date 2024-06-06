<?php

use mdb\PersonDB;

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

// Get parameters
$firstName = htmlspecialchars($_POST['firstName'] ?? "");
$lastName = htmlspecialchars($_POST['lastName'] ?? "");
$birthDate = htmlspecialchars($_POST['birthDate'] ?? "0000-00-00");
$deathDate = htmlspecialchars($_POST['deathDate'] ?? "0000-00-00");

$firsNameOperator = htmlspecialchars($_POST['firstNameOperator'] ?? "LIKE"); if ($firsNameOperator == "null") { $firsNameOperator = "LIKE"; }
$lastNameOperator = htmlspecialchars($_POST['lastNameOperator'] ?? "LIKE"); if ($lastNameOperator == "null") { $lastNameOperator = "LIKE"; }
$birthDateOperator = ($_POST['birthDateOperator'] ?? ">"); if ($birthDateOperator == "null") { $birthDateOperator = ">"; }
$deathDateOperator = ($_POST['deathDateOperator'] ?? ">"); if ($deathDateOperator == "null") { $deathDateOperator = ">"; }

$nbOtherPerson = htmlspecialchars($_POST['nbOtherPerson'] ?? 0);
$otherPerson = [];
$otherPersonOperator = htmlspecialchars($_POST['otherPersonOperator'] ?? "AND"); if ($otherPersonOperator == "null") { $otherPersonOperator = "AND"; }
for ($i = 0; $i < $nbOtherPerson; $i++) { $otherPerson[] = htmlspecialchars($_POST['otherPerson' . $i]); }


$nbTags = htmlspecialchars($_POST['nbTags'] ?? 0);
$tags = [];
$tagsOperator = htmlspecialchars($_POST['tagsOperator'] ?? "AND"); if ($tagsOperator == "null") { $tagsOperator = "AND"; }
for ($i = 0; $i < $nbTags; $i++) { $tags[] = htmlspecialchars($_POST['tag' . $i]); }

try
{
    $personDB = new PersonDB();
    $persons = $personDB->advancedPersonSearch($firstName, $lastName, $birthDate, $deathDate, $firsNameOperator, $lastNameOperator, $birthDateOperator, $deathDateOperator, $otherPerson, $otherPersonOperator, $tags, $tagsOperator);
    echo json_encode(['success' => true, 'data' => json_encode($persons)]);
}
catch (Exception $e)
{
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}