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

    $pdo = new PdoWrapper($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    $data = $pdo->execute("SELECT * FROM movies", null);

    foreach ($data as $movie)
    {
        echo "<div class='film'>";
        echo "<h3>" . $movie->title . " (" . $movie->release_date . ")</h3>";
        echo "<p>" . $movie->synopsis . "</p>";
        echo "</div>";
    }

    ?>
</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
