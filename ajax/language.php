<?php
require_once "../config.php";
require_once $GLOBALS['LOCALIZATION_DIR'] . $GLOBALS['CURRENT_LANGUAGE'] . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

if (isset($_POST['method']))
{
    $method = $_POST['method'];

    if ($method == 'get') { echo json_encode(['success' => true, 'language' => (Cookies::get('language') ?? 'EN')]); }
    else if ($method == 'set')
    {
        if (isset($_POST['language']))
        {
            if (Cookies::set('language', $_POST['language'], time() + 365 * 24 * 3600)) { echo json_encode(['success' => true]); }
            else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-language-error-4']]); }
        }
        else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-language-error-3']]); }
    }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-language-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-language-error-1']]); }