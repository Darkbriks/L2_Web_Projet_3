<?php
require_once "../config.php";
require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>
<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
