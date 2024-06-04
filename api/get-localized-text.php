<?php
require_once "../config.php";

if (!isset($_POST['lang'])) { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-localized-text-error-1']]); exit(); }

require_once $GLOBALS['LOCALIZATION_DIR'] . $_POST['lang'] . '.php';

if (isset($_POST['text']))
{
    $text = htmlspecialchars($_POST['text']);
    $localizedText = $GLOBALS[$text] ?? null;
    if ($localizedText) { echo json_encode(['success' => true, 'localizedText' => $localizedText]); }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-localized-text-error-2']]); }
}
else { echo json_encode(['success' => false, 'error' => $GLOBALS['api-get-localized-text-error-3']]); }