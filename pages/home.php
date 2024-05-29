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

    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovies();
    foreach ($movies as $movie) { echo $movie->getHtml(); }

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
