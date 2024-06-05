<?php
$admin_user = 'admin';
$admin_pass = 'admin';

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

if (isset($_POST['username']) || isset($_POST['password'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['admin'] = true;
    } else {
        $login_error = $GLOBALS['login-error'];
    }
}

// Sauvegarder l'action dans la session si elle est définie
if (isset($_POST['action'])) {
    $_SESSION['action'] = $_POST['action'];
}

// Récupérer l'action depuis la session si elle existe
$action = $_SESSION['action'] ?? null;

?>

<?php ob_start(); ?>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
    <!-- TODO: Ajouter les deux boutons "Ajouter" et "Modifier" -->
    <form method="POST" enctype="multipart/form-data">
        <!-- Vos champs de formulaire ici-->

        <div class="mb-3">
            <button type="submit" name="action" value="add" class="btn btn-success">Ajouter</button>
            <button type="submit" name="action" value="edit" class="btn btn-warning">Modifier</button>
        </div>
    </form>

    <?php
    // Vérifier l'action stockée dans la session
    if ($action === 'add') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            try {
                $movieForm = new mdb\MovieForm();
                $img_file = $_FILES['posters'] ?? null;
                $movieForm->createMovie($_POST, $img_file);
                $add_movie_success = $GLOBALS['admin-movie-success'];
            } catch (Exception $e) {
                $add_movie_error = $e->getMessage();
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['person-first-name'])) {
            try {
                $personForm = new mdb\PersonForm();
                $img_file = $_FILES['person-image'] ?? null;
                $personForm->createPerson($_POST, $img_file);
                ?><script> document.addEventListener('DOMContentLoaded', function() {
                        set_user_msg("<?php echo $GLOBALS['admin-person-success'] ?>", 'success');
                    }); </script><?php
            } catch (Exception $e) {
                ?><script> document.addEventListener('DOMContentLoaded', function() {
                        set_user_msg("<?php echo $e->getMessage(); ?>", 'danger');
                    }); </script><?php
            }
        }
        include "add-person-form.php";
        include "add-movie-form.php";
    } else if ($action === 'edit') {
        include "update-person-form.php";
        include "update-tag-form.php";
        include "add-person-to-movie-form.php";
        include "update-movie-form.php";
    }
} else {
    include "login.php";
}

?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
?>
