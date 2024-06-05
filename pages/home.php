<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

?>

<?php ob_start(); ?>

<h1><?php echo $GLOBALS['home-most-popular-title']; ?></h1>
<div id="home-list">
    <script src="../js/allMovies.js"></script>
    <div class="carrousel" id="movies-container"></div>
    <div class="mb-3"><button type="button" class="btn-home" id="random-home"><?php echo $GLOBALS['random-home-title']; ?></button></div>
</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);