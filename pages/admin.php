<?php
$admin_user = 'admin';
$admin_pass = 'admin';

require_once "../config.php";
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

<?php if (isset($_SESSION['admin']) && $_SESSION['admin'])
{
    ?>
    <h2>Ajouter un Nouveau Film depuis une API</h2>
    <form id="addFilmFromAPIForm" action="add_film_from_api.php" method="POST">
        <label for="film_name">Nom du Film :</label>
        <input type="text" id="film_name" name="film_name" required>
        <input type="submit" value="Rechercher">
    </form>

    <h2>Ajouter un Nouveau Film Manuellement</h2>

    <?php
}
else { include "login.php"; } ?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
