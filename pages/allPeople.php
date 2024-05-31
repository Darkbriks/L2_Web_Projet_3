<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

    <script src="../js/allPeople.js"></script>

    <h1>PEOPLES</h1>
    <div class="peoples-container" id="peoples-container"></div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);