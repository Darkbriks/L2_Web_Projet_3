<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];
use pdo_wrapper\PdoWrapper;

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

<h2>Liste des Films</h2>
<div id="film-list">
    <?php
    // Obtenir la liste des films de la base de données
    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovies();

    // Parcourir chaque film
    foreach ($movies as $movie) {
        // Afficher le HTML du film
        echo $movie->getHtml();

        // Obtenir les acteurs associés à ce film
        $actorsDB = new mdb\PersonDB();
        $actors = $actorsDB->getActorsOfMovie($movie->id);
        $persons = $actorsDB->getDirectorOfMovie($movie->id);

        // Afficher les acteurs associés à ce film
        foreach ($actors as $actor) {
            echo $actor->getHtml_Actor();
        }
        foreach ($persons as $person) {
            echo $person->getHtml_Director();
        }
    }

    ?>
</div>

<h2>Film dont l'id est 1</h2>
<div id="film-list">
    <?php

    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovieById(1);
    foreach ($movies as $movie) { echo $movie->getHtml(); }

    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
