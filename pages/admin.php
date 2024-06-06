<?php

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
use mdb\AccountDB;
$accountDB = new AccountDB();
$accounts = $accountDB->getAccounts();

$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

if (isset($_POST['username']) || isset($_POST['password'])) {
    foreach ($accounts as $account) {
        if(password_verify($_POST['username'], $account->getUsername()) && password_verify($_POST['username'], $account->getPassword())) {
            $_SESSION['admin'] = true;
        }
    }
    if(isset($_SESSION['admin']) && $_SESSION['admin'] !== true) {
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
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <button type="submit" name="action" value="add" class="btn-admin">Ajouter</button>
            <button type="submit" name="action" value="edit" class="btn-admin">Modifier</button>
        </div>
    </form>
    <?php
    // Vérifier l'action stockée dans la session
    if ($action === 'add') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            try {
                $movieForm = new \mdb\form\MovieForm();
                $img_file = $_FILES['image-path'] ?? null;
                $movieForm->Movie($_POST, $img_file);
                $add_movie_success = $GLOBALS['admin-movie-success'];
            } catch (Exception $e) {
                $add_movie_error = $e->getMessage();
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['person-first-name'])) {
            try {
                $personForm = new \mdb\form\PersonForm();
                $img_file = $_FILES['person-image'] ?? null;
                $personForm->Person($_POST, $img_file);
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
    } else if ($action === 'edit') {?>
        <div class="mb-3">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['person-first-name'])) {
                $personForm = new \mdb\form\PersonForm();
                $img_file = $_FILES['person-image-path'] ?? null;
                try {
                    $personForm->Person($_POST, $img_file, $_POST['person_id']);
                ?><script> document.addEventListener('DOMContentLoaded', function() {
                        set_user_msg("<?php echo $GLOBALS['admin-person-success'] ?>", 'success');
                    }); </script><?php
                } catch (Exception $e) {
                ?><script> document.addEventListener('DOMContentLoaded', function() {
                        set_user_msg("<?php echo $e->getMessage(); ?>", 'danger');
                    }); </script><?php
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
                try {
                    $movieForm = new \mdb\form\MovieForm();
                    $img_file = $_FILES['image_path'] ?? null;
                    $movieForm->Movie($_POST, $img_file,$_POST['movie_id']);
                    $add_movie_success = $GLOBALS['admin-movie-success'];
                } catch (Exception $e) {
                    $add_movie_error = $e->getMessage();
                }
            }
            include "add-person-to-movie-form.php";
            include "update-person-form.php";
            include "update-tag-form.php";
            ?>
        </div>
    <?php
        include "update-movie-form.php";
    }
} else {
    include "login.php";
}

?>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
?>
