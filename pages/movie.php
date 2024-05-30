<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

    <h2><?php echo $_GET['title'];?></h2>

    <?php
    $id = $_GET['id'];
    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovieById($id);
    echo $movies[0]->getHtml();

    $personDB = new mdb\PersonDB();
    $directors = $personDB->getDirectorsOfMovie($movies[0]->id);
    $actors = $personDB->getActorsOfMovie($movies[0]->id);
    $composers = $personDB->getComposersOfMovie($movies[0]->id);

    ?><h3>DIRECTOR(S)</h3>
    <ul><?php
    foreach ($directors as $director) { echo $director->getHtml_Director(); }
    ?></ul><?php

    ?><h3>ACTOR(S)</h3>
    <ul><?php
    foreach ($actors as $actor) { echo $actor->getHtml_list(true); }
    ?></ul><?php

    ?><h3>COMPOSER(S)</h3>
    <ul><?php
    foreach ($composers as $composer) { echo $composer->getHtml_list(); }
?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);