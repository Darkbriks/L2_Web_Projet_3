<?php
require_once "../config.php";
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
            else { echo json_encode(['success' => false, 'error' => 'Cookie could not be set']); }
        }
        else { echo json_encode(['success' => false, 'error' => 'No language provided']); }
    }
    else { echo json_encode(['success' => false, 'error' => 'Invalid method']); }
}
else { echo json_encode(['success' => false, 'error' => 'No method provided']); }