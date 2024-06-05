<?php

use mdb\MoviesDB;

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

// Get parameters
$title = htmlspecialchars($_POST['title'] ?? "");
$titleOperator = htmlspecialchars($_POST['titleOperator'] ?? "LIKE"); if ($titleOperator == "null") { $titleOperator = "LIKE"; }
$release = htmlspecialchars($_POST['release'] ?? "000-00-00"); if ($release == "") { $release = "000-00-00"; }
$releaseOperator = htmlspecialchars($_POST['releaseOperator'] ?? ">"); if ($releaseOperator == "null") { $releaseOperator = ">"; }
$duration = htmlspecialchars($_POST['duration'] ?? "0"); if ($duration == "") { $duration = "0"; }
$durationOperator = htmlspecialchars($_POST['durationOperator'] ?? ">"); if ($durationOperator == "null") { $durationOperator = ">"; }
$rating = htmlspecialchars($_POST['rating'] ?? "-1"); if ($rating == "") { $rating = "-1"; }
$ratingOperator = htmlspecialchars($_POST['ratingOperator'] ?? ">"); if ($ratingOperator == "null") { $ratingOperator = ">"; }
$note = htmlspecialchars($_POST['note'] ?? "-1"); if ($note == "") { $note = "-1"; }
$noteOperator = htmlspecialchars($_POST['noteOperator'] ?? ">"); if ($noteOperator == "null") { $noteOperator = ">"; }
$seen = htmlspecialchars($_POST['seen'] ?? "-1"); if ($seen == "null") { $seen = "-1"; }
$synopsis = htmlspecialchars($_POST['synopsis'] ?? "");
$synopsisOperator = htmlspecialchars($_POST['synopsisOperator'] ?? "LIKE"); if ($synopsisOperator == "null") { $synopsisOperator = "LIKE"; }

$nbDirectors = htmlspecialchars($_POST['nbDirectors'] ?? 0);
$directors = [];
$directorsOperator = htmlspecialchars($_POST['directorsOperator'] ?? "AND"); if ($directorsOperator == "null") { $directorsOperator = "AND"; }
for ($i = 0; $i < $nbDirectors; $i++) { $directors[] = htmlspecialchars($_POST['director' . $i]); }

$nbActors = htmlspecialchars($_POST['nbActors'] ?? 0);
$actors = [];
$actorsOperator = htmlspecialchars($_POST['actorsOperator'] ?? "AND"); if ($actorsOperator == "null") { $actorsOperator = "AND"; }
for ($i = 0; $i < $nbActors; $i++) { $actors[] = htmlspecialchars($_POST['actor' . $i]); }

$nbComposers = htmlspecialchars($_POST['nbComposers'] ?? 0);
$composers = [];
$composersOperator = htmlspecialchars($_POST['composersOperator'] ?? "AND"); if ($composersOperator == "null") { $composersOperator = "AND"; }
for ($i = 0; $i < $nbComposers; $i++) { $composers[] = htmlspecialchars($_POST['composer' . $i]); }

$nbTags = htmlspecialchars($_POST['nbTags'] ?? 0);
$tags = [];
$tagsOperator = htmlspecialchars($_POST['tagsOperator'] ?? "AND"); if ($tagsOperator == "null") { $tagsOperator = "AND"; }
for ($i = 0; $i < $nbTags; $i++) { $tags[] = htmlspecialchars($_POST['tag' . $i]); }

// Get movies
try
{
    $moviesDB = new MoviesDB();
    $movies = $moviesDB->advancedMovieSearch($title, $titleOperator, $release, $releaseOperator, $duration, $durationOperator, $rating, $ratingOperator, $note, $noteOperator, $seen, $synopsis, $synopsisOperator, $directors, $directorsOperator, $actors, $actorsOperator, $composers, $composersOperator, $tags, $tagsOperator);
    echo json_encode(['success' => true, 'data' => json_encode($movies)]);
}
catch (Exception $e)
{
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}