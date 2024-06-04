<?php
require_once "../config.php";

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

if (isset($_POST['method']))
{
    $method = $_POST['method'];

    if ($method == 'get') { echo json_encode(['success' => true, 'language' => $lang]); }
    else if ($method == 'set')
    {
        if (isset($_POST['language']))
        {
            if (in_array($_POST['language'], $GLOBALS['languages-list']))
            {
                $_SESSION['language'] = $_POST['language'];
                echo json_encode(['success' => true]);
            }
            else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-language-error-4']]); }
        }
        else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-language-error-3']]); }
    }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-language-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-language-error-1']]); }