<?php
require_once "../config.php";

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

if (isset($_POST['text']))
{
    $text = htmlspecialchars($_POST['text']);
    $localizedText = $GLOBALS[$text] ?? null;
    if ($localizedText) { echo json_encode(['success' => true, 'localizedText' => $localizedText]); }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-localized-text-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-localized-text-error-3']]); }