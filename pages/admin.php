<?php
$admin_user = 'admin';
$admin_pass = 'admin';

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

//$lang = Cookies::get('language');
$lang = $GLOBALS['CURRENT_LANGUAGE'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

session_start();

if (isset($_POST['username']) || isset($_POST['password']))
{
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) { $_SESSION['admin'] = true; }
    else { $login_error = $GLOBALS['login-error']; }
}

?>

<?php ob_start(); ?>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
{?>
    <!-- TODO: Ajouter les deux boutons "Ajouter" et "Modifier" -->
    <form method="POST" enctype="multipart/form-data">
        <!-- Vos champs de formulaire ici

        <div class="mb-3">
            <button type="submit" name="action" value="add" class="btn btn-success">Ajouter</button>
            <button type="submit" name="action" value="edit" class="btn btn-warning">Modifier</button>
        </div>
    </form>-->


    <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add'){
        include "add-person-form.php";
        include "add-movie-form.php";
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit'){
        include "update-person-form.php";
        include "update-movie-form.php";
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']))
    {
        try
        {
            $movieForm = new mdb\MovieForm();
            $img_file = $_FILES['posters'] ?? null;
            $movieForm->createMovie($_POST, $img_file);
            $add_movie_success = $GLOBALS['admin-movie-success'];
        }
        catch (Exception $e) { $add_movie_error = $e->getMessage(); }
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['person-first-name']))
    {
        try
        {
            $personForm = new mdb\PersonForm();
            $img_file = $_FILES['person-image'] ?? null;
            $personForm->createPerson($_POST, $img_file);
            ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $GLOBALS['admin-person-success'] ?>", 'success'); }); </script><?php
        }
        catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage(); ?>", 'danger'); }); </script><?php }
    }
    include "update-person-form.php";
    include "update-movie-form.php";
}
else { include "login.php"; }
?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
