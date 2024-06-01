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
{
    $movieForm = new mdb\MovieForm();
    $img_file = $_FILES['posters'] ?? null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']))
    {
        try
        {
            $movieForm->createMovie($_POST, $img_file);
            echo "<p>" . $GLOBALS['admin-movie-success'] . "</p>";
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    //echo $movieForm->getForm();
    include "add-movie-form.php";
}
else { include "login.php"; }
?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
