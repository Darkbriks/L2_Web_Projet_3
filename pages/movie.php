<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

$admin = $_SESSION['admin'] ?? false;
?>

<?php ob_start(); ?>

<div class="container movie-container">

<?php try
{
    if (!isset($_GET['id'])) { throw new Exception($GLOBALS['movie-error-1'], 1); }
    $id = (int)htmlspecialchars($_GET['id']);
    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovieById($id);
    if (count($movies) == 0) { throw new Exception($GLOBALS['movie-error-2'] . $id, 2); }
    echo $movies[0]->getHtml($admin);

    $personDB = new mdb\PersonDB();
    $directors = $personDB->getDirectorsOfMovie($movies[0]->id);
    $actors = $personDB->getActorsOfMovie($movies[0]->id);
    $composers = $personDB->getComposersOfMovie($movies[0]->id);

    if (count($directors) > 0) { ?><h3><?php echo $GLOBALS['movie-directors'] ?></h3><div class="person-card-list"><?php foreach ($directors as $director) { echo $director->getHtml_card(); } ?></div><?php }

    if (count($directors) > 0) { ?><h3><?php echo $GLOBALS['movie-actors'] ?></h3> <div class="person-card-list"><?php foreach ($actors as $actor) { echo $actor->getHtml_card(true); } ?></div><?php }

    if (count($directors) > 0) { ?><h3><?php echo $GLOBALS['movie-composers'] ?></h3> <div class="person-card-list"><?php foreach ($composers as $composer) { echo $composer->getHtml_card(); } ?></div><?php }
}
catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger"); }); </script> <?php } ?>

</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content); ?>
