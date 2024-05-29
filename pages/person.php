<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

    <h2><?php echo $_GET['fullName'];?></h2>

    <?php
    $id = $_GET['id'];
    $actorsDB = new mdb\PersonDB();
    $actors = $actorsDB->getPersonById($id);
    echo $actors[0]->getHtml_Director();
    ?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);