<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

use mdb\MoviesDB;

if (isset($_POST['id'])) {
    try {
        $moviesDB = new MoviesDB();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit();
    }

    function updateMovieState($moviesDB, $id, $stateKey, $stateValue, $successMessage) {
        try {
            $state = $stateValue === 'true' ? 1 : 0;
            if ($stateKey === 'seen') {
                $moviesDB->setSeen(htmlspecialchars($id), $state);
            } elseif ($stateKey === 'favorite') {
                $moviesDB->setFavorite(htmlspecialchars($id), $state);
            }
            echo json_encode(['success' => true, 'data' => $successMessage]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    if (isset($_POST['seen'])) {
        updateMovieState($moviesDB, $_POST['id'], 'seen', $_POST['seen'], $GLOBALS['api-set-seen-success']);
    }

    if (isset($_POST['favorite'])) {
        updateMovieState($moviesDB, $_POST['id'], 'favorite', $_POST['favorite'], $GLOBALS['api-set-seen-success']);
    }
} else {
    echo json_encode(['success' => false, 'error' => $GLOBALS['api-set-seen-error-1']]);
}

