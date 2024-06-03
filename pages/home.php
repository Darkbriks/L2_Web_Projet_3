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

<h1><?php echo $GLOBALS['home-most-popular-title']; ?></h1>
<div id="film-list">
    <?php
    try
    {
        $moviesDB = new mdb\MoviesDB();
        $movies = $moviesDB->getMovieById(1);
        foreach ($movies as $movie) { echo $movie->getHtml(); }
    }
    catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger"); }); </script> <?php }
    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);