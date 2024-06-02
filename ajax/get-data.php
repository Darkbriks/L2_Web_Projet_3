<?php

use mdb\MoviesDB;
use mdb\PersonDB;
use mdb\TagDB;

require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $GLOBALS['CURRENT_LANGUAGE'] . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

// Parameters
// - table: string, the table used to get the data
// - conditionLength: int, the number of conditions to get (default: 1)(if 0, get all data)
// - attributes: array, the attributes used to filter the data
// - values: array, the values used to filter the data
// - and: boolean, if true, use AND instead of OR (default: true)
// - limit: int, the number of rows to get (default: 10)
// - order: string, the column used to order the data (default: 'id')
// - direction: string, the direction used to order the data (default: 'ASC')
// - useLike: boolean, if true, use LIKE instead of = (default: false)

try
{
    if (isset($_POST['table']))
    {
        $table = htmlspecialchars($_POST['table']);
        if ($table === 'movies') { $db = new MoviesDB(); }
        else if ($table === 'person') { $db = new PersonDB(); }
        else if ($table === 'tag') { $db = new TagDB(); }
        else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-get-data-table-not-valid']]); exit(); }

        if (isset($_POST['conditionLength']))
        {
            $conditionLength = htmlspecialchars($_POST['conditionLength']);
            $attributes = [];
            $values = [];
            for ($i = 0; $i < $conditionLength; $i++)
            {
                if (!isset($_POST['attribute' . $i]) || !isset($_POST['value' . $i])) { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-get-data-attribute-value-not-set']]); exit(); }
                $attributes[] = htmlspecialchars($_POST['attribute' . $i]);
                $values[] = htmlspecialchars($_POST['value' . $i]);
            }

            $and = htmlspecialchars($_POST['and'] ?? true);
            $limit = htmlspecialchars($_POST['limit'] ?? 10);
            $order = htmlspecialchars($_POST['order'] ?? 'id');
            $direction = htmlspecialchars($_POST['direction'] ?? 'ASC');
            $useLike = htmlspecialchars($_POST['useLike'] ?? false);

            try
            {
                $data = $db->getData($attributes, $values, $and, $limit, $order, $direction, $useLike);
                $json_data = json_encode(array_map(function($d) { return $d->get_json(); }, $data));
                echo json_encode(['success' => true, 'data' => $json_data, 'len' => count($data)]);
            }
            catch (Exception $e) { echo json_encode(['success' => false, 'error' => $e->getMessage()]); exit(); }
        }
        else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-get-data-attribute-value-not-set']]); exit(); }

    }
    else { echo json_encode(['success' => false, 'error' => $GLOBALS['ajax-get-data-table-not-set']]); exit(); }
}
catch (Exception $e)
{
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit();
}