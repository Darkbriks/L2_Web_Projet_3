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

    $actorsDB = new mdb\PersonDB();
    $actors = $actorsDB->getActorsOfMovie($movies[0]->id);
    $directors = $actorsDB->getDirectorOfMovie($movies[0]->id);

    ?><h3>DIRECTOR(S)</h3><?php
    foreach ($directors as $director) { echo $director->getHtml_Director(); }

    ?><h3>ACTOR(S)</h3>
    <ul><?php
    foreach ($actors as $actor) { echo $actor->getHtml_list(true); }
    ?></ul>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);