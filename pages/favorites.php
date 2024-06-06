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

    <h1 class="title"><?php echo $GLOBALS['favorites-title']; ?></h1>
    <div id="favorites-list">
        <script src="../js/allMovies.js"></script>
        <div class="carrousel" id="movies-container"></div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);