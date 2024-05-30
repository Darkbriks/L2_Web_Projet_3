<?php
$admin_user = 'admin';
$admin_pass = 'admin';

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password']))
{
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) { $_SESSION['admin'] = true; }
    else { $login_error = "Nom d'utilisateur ou mot de passe incorrect"; }
}
?>

<?php ob_start(); ?>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
{
    $movieForm = new mdb\MovieForm();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']))
    {
        try { $movieForm->createMovie($_POST); }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    echo $movieForm->getForm();
}
else { include "login.php"; }
?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
