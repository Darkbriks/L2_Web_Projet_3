<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

    <h2>Liste des Acteurs</h2>
    <div id="film-list">
        <ul>
            <?php
            $actorsDB = new mdb\PersonDB();
            $actors = $actorsDB->getActors();
            foreach ($actors as $actor) { echo $actor->getHtml_list(); } ?>
        </ul>
    </div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);