<?php

namespace mdb\form;

use Exception;
use mdb\PersonDB;

class PersonForm
{
    /**
     * @throws Exception
     */
    public static function Person(array $data, $img_file, $person_id = null): int
    {
        PersonForm::checkForm($data, $img_file);

        try { $data['image-path'] = ValidateForm::saveImage($img_file, 'uploads/peoples/'); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }

        $personDB = new PersonDB();
        if($person_id === null)
        {
            $id = $personDB->addPersonAndReturnId($data['person-first-name'], $data['person-last-name'], $data['person-birth-date'], $data['person-death-date'], $data['image-path']);
            if ($id === 0) { throw new Exception($GLOBALS['person-form-exception-adding']); }
            return $id;
        }
        else { $personDB->alterPerson($person_id, $data['person-first-name'], $data['person-last-name'], $data['person-birth-date'], $data['person-death-date'], $data['image-path']); return $person_id;}
    }

    /**
     * @throws Exception
     */
    private static function checkForm(array $data, $img_file): void
    {
        $data = ValidateForm::convertData($data);

        ValidateForm::validateTextInput($data['person-first-name'], $GLOBALS['person-form-exception-first-name']);
        ValidateForm::validateTextInput($data['person-last-name'], $GLOBALS['person-form-exception-last-name']);
        ValidateForm::validateDateInput($data['person-birth-date'], $GLOBALS['person-form-exception-birth-date']);
        ValidateForm::validatePotentiallyEmptyDateInput($data['person-death-date'], $GLOBALS['person-form-exception-death-date']);
        ValidateForm::validateImageInput($img_file, $GLOBALS['person-form-exception-image']);
    }
}