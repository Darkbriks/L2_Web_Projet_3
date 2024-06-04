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

    <?php
    try
    {
        if (!isset($_GET['id'])) { throw new Exception($GLOBALS['person-error-1'], 1); }
        $id = htmlspecialchars($_GET['id']);
        $actorsDB = new mdb\PersonDB();
        $actors = $actorsDB->getPersonById($id);
        if (count($actors) == 0) { throw new Exception($GLOBALS['person-error-2'] . $id, 2); }
        echo $actors[0]->getHtml_Person();
    }
    catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger"); }); </script> <?php }
    ?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);