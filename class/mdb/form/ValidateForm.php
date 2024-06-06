<?php

namespace mdb\form;

use Exception;

class ValidateForm
{
    /**
     * @throws Exception
     */
    public static function validateTextInput($input, $exception, $minLength = 3, $maxLength = 50): void
    {
        if ($input === null || strlen($input) < $minLength || strlen($input) > $maxLength)
        { throw new Exception($exception); }
    }

    /**
     * @throws Exception
     */
    public static function validateNumberInput($input, $exception, $min = 0, $max = 999): void
    {
        if (!is_numeric($input) || $input < $min || $input > $max) { throw new Exception($exception); }
    }

    /**
     * @throws Exception
     */
    public static function validateDateInput($input, $exception): void
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $input) === 0) { throw new Exception($exception); }
    }

    /**
     * @throws Exception
     */
    public static function validatePotentiallyEmptyDateInput($input, $exception)
    {
        if ($input === '0000-00-00') { return null; }
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $input) === 0) { throw new Exception($exception); }
    }

    /**
     * @throws Exception
     */
    public static function validateImageInput($image, $exception): void
    {
        if ($image['error'] !== 0 || !in_array($image['type'], ['image/jpeg', 'image/jpg', 'image/png'])) { throw new Exception($exception); }
    }

    public static function convertData($data): array
    {
        foreach ($data as $key => $value) { if (is_array($value)) { foreach ($value as $k => $v) { $data[$key][$k] = htmlspecialchars(trim($v)); } } else { $data[$key] = htmlspecialchars(trim($value)); } }
        return $data;
    }

    /**
     * @throws Exception
     */
    public static function saveImage(array $image, string $imageDir): string
    {
        $tmp_name = $image['tmp_name'];
        $img_name = $image['name'];
        $img_name = urldecode(htmlspecialchars($img_name));
        $dir = $GLOBALS['PHP_DIR'] . $imageDir;
        if (!is_dir($dir)) { mkdir($dir); }
        $uploaded = move_uploaded_file($tmp_name, $dir . $img_name);
        if (!$uploaded) { throw new Exception($GLOBALS['person-form-exception-upload']); }
        return $img_name;
    }
}