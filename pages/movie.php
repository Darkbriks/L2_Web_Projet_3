<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

//$lang = Cookies::get('language');
$lang = $GLOBALS['CURRENT_LANGUAGE'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

?>

<?php ob_start(); ?>

<?php

try
{
    if (!isset($_GET['id'])) { throw new Exception($GLOBALS['movie-error-1'], 1); }
    $id = (int)htmlspecialchars($_GET['id']);
    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovieById($id);
    if (count($movies) == 0) { throw new Exception($GLOBALS['movie-error-2'] . $id, 2); }
    echo $movies[0]->getHtml();

    $personDB = new mdb\PersonDB();
    $directors = $personDB->getDirectorsOfMovie($movies[0]->id);
    $actors = $personDB->getActorsOfMovie($movies[0]->id);
    $composers = $personDB->getComposersOfMovie($movies[0]->id);

    ?><h3><?php echo $GLOBALS['movie-directors'] ?></h3><ul><?php foreach ($directors as $director) { echo $director->getHtml_list(); } ?></ul><?php

    ?><h3><?php echo $GLOBALS['movie-actors'] ?></h3> <ul><?php foreach ($actors as $actor) { echo $actor->getHtml_list(true); } ?></ul><?php

    ?><h3><?php echo $GLOBALS['movie-composers'] ?></h3> <ul><?php foreach ($composers as $composer) { echo $composer->getHtml_list(); } ?></ul><?php
}
catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger"); }); </script> <?php } ?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content); ?>
