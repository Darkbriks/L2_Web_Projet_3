<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

session_start();

// TODO: localization
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) { json_encode(['success' => false, 'error' => 'You must be an admin to access this page']); exit(); }

$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

if (isset($_FILES['file']) && isset($_POST['dir']))
{
    $dir = $_POST['dir'];
    $file = $_FILES['file'];

    try {
        \mdb\form\ValidateForm::validateImageInput($file, "An error occured while uploading the image");
        \mdb\form\ValidateForm::saveImage($file, $dir);
        echo json_encode(['success' => true, 'data' => $file['name']]);
    }
    catch (Exception $e)
    {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit();
    }
}
else
{
    echo json_encode(['success' => false, 'error' => 'No file or directory specified']);
}