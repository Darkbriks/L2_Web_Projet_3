<?php

namespace mdb\form;

use Exception;
use mdb\PersonDB;

class PersonForm
{
    const IMAGE_DIR = 'uploads/peoples/';

    /**
     * @throws Exception
     */
    public function createPerson(array $data, $img_file): void
    {
        foreach ($data as $key => $value) { $data[$key] = htmlspecialchars(trim($value)); }
        $data['person-death-date'] = (isset($data['person-death-date'])) ? $data['person-death-date'] : null;
        $this->checkForm($data, $img_file);

        try { $data['image-path'] = $this->saveImage($img_file); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }

        if ($this->saveActor($data) === 0) { throw new Exception($GLOBALS['person-form-exception-adding']); }
    }

    /**
     * @throws Exception
     */
    public function alterPerson(int $person_id, array $data, $img_file = null): void
    {
        foreach ($data as $key => $value) { $data[$key] = htmlspecialchars(trim($value)); }
        $data['person-death_date'] = (isset($data['person-death-date'])) ? $data['person-death-date'] : null;
        $this->checkForm($data, $img_file);

        try { $data['image-path'] = $this->saveImage($img_file); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }


        $this->updateActor($person_id,$data);
    }

    /**
     * @throws Exception
     */
    private function updateActor(int $person_id, array $data): void
    {
        $personDB = new PersonDB();
        $personDB->alterPersonReturnID($person_id, $data['person-first-name'], $data['person-last-name'], $data['person-birth-date'], $data['person-death_date'], $data['image-path']);
    }

    /**
     * @throws Exception
     */
    public function saveImage(array $image): string
    {
        $tmp_name = $image['tmp_name'];
        $img_name = $image['name'];
        $img_name = urldecode(htmlspecialchars($img_name));
        $dir = $GLOBALS['PHP_DIR'] . self::IMAGE_DIR;
        if (!is_dir($dir)) { mkdir($dir); }
        $uploaded = move_uploaded_file($tmp_name, $dir . $img_name);
        if (!$uploaded) { throw new Exception($GLOBALS['person-form-exception-upload']); }
        return $img_name;
    }

    private function saveActor(array $data): int
    {
        $personDB = new PersonDB();
        return $personDB->addPersonAndReturnId($data['person-first-name'], $data['person-last-name'], $data['person-birth-date'], $data['person-death-date'], $data['image-path']);
    }


    /**
     * @throws Exception
     */
    private function checkForm(array $data, $img_file): void
    {
        // Le prénom ne doit pas être vide, et doit contenir entre 2 et 50 caractères
        $data['person-first-name'] = htmlspecialchars(trim($data['person-first-name']));
        if (empty($data['person-first-name']) || strlen($data['person-first-name']) < 2 || strlen($data['person-first-name']) > 50)
        {
            throw new Exception($GLOBALS['person-form-exception-first-name']);
        }

        // Le nom ne doit pas être vide, et doit contenir entre 2 et 50 caractères
        $data['person-last-name'] = htmlspecialchars(trim($data['person-last-name']));
        if (empty($data['person-last-name']) || strlen($data['person-last-name']) < 2 || strlen($data['person-last-name']) > 50)
        {
            throw new Exception($GLOBALS['person-form-exception-last-name']);
        }

        // La date de naissance ne doit pas être vide, et doit être au format YYYY-MM-DD
        $data['person-birth-date'] = htmlspecialchars(trim($data['person-birth-date']));
        if (empty($data['person-birth-date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['person-birth-date']))
        {
            throw new Exception($GLOBALS['person-form-exception-birth-date']);
        }

        // La date de décès peut être vide, mais si elle est fournie, elle doit être au format YYYY-MM-DD
        if (!empty($data['person-death-date']))
        {
            $data['person-death-date'] = htmlspecialchars(trim($data['person-death-date']));
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['person-death-date']))
            {
                throw new Exception($GLOBALS['person-form-exception-death-date']);
            }
        }

        // L'image ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        if (empty($img_file['name']) || !in_array($img_file['type'], ['image/jpeg', 'image/jpg', 'image/png']))
        { throw new Exception($GLOBALS['person-form-exception-image']); }
    }

}
