<?php

namespace mdb;

use Exception;

class ActorForm
{
    const IMAGE_DIR = 'uploads/images/';

    /**
     * @throws Exception
     */
    public function createActor(array $data, $img_file): void
    {
        $this->checkForm($data, $img_file);

        // Save actor to database
        try {
            $data['image_path'] = $this->saveImage($img_file);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $actor_id = $this->saveActor($data);
        if ($actor_id === 0) {
            throw new Exception($GLOBALS['actor-form-exception-adding']);
        }
    }

    /**
     * @throws Exception
     */
    private function saveImage(array $image): string
    {
        $tmp_name = $image['tmp_name'];
        $img_name = $image['name'];
        $img_name = urldecode(htmlspecialchars($img_name));
        $dir = $GLOBALS['PHP_DIR'] . self::IMAGE_DIR;
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $uploaded = move_uploaded_file($tmp_name, $dir . $img_name);
        if (!$uploaded) {
            throw new Exception($GLOBALS['actor-form-exception-upload']);
        }
        return $img_name;
    }

    private function saveActor(array $data): int
    {
        $personDB = new PersonDB();
        return $personDB->addPersonAndReturnId($data['first_name'], $data['last_name'], $data['birth_date'], $data['death_date'], $data['type'], $data['image_path']);
    }

    /**
     * @throws Exception
     */
    private function checkForm(array $data, $img_file): void
    {
        // Le prénom ne doit pas être vide, et doit contenir entre 2 et 50 caractères
        $data['first_name'] = htmlspecialchars(trim($data['first_name']));
        if (empty($data['first_name']) || strlen($data['first_name']) < 2 || strlen($data['first_name']) > 50) {
            throw new Exception($GLOBALS['actor-form-exception-first-name']);
        }

        // Le nom ne doit pas être vide, et doit contenir entre 2 et 50 caractères
        $data['last_name'] = htmlspecialchars(trim($data['last_name']));
        if (empty($data['last_name']) || strlen($data['last_name']) < 2 || strlen($data['last_name']) > 50) {
            throw new Exception($GLOBALS['actor-form-exception-last-name']);
        }

        // La date de naissance ne doit pas être vide, et doit être au format YYYY-MM-DD
        $data['birth_date'] = htmlspecialchars(trim($data['birth_date']));
        if (empty($data['birth_date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['birth_date'])) {
            throw new Exception($GLOBALS['actor-form-exception-birth-date']);
        }

        // La date de décès peut être vide, mais si elle est fournie, elle doit être au format YYYY-MM-DD
        if (!empty($data['death_date'])) {
            $data['death_date'] = htmlspecialchars(trim($data['death_date']));
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['death_date'])) {
                throw new Exception($GLOBALS['actor-form-exception-death-date']);
            }
        }

        // L'image ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        if (empty($img_file['image_path']) || !in_array($img_file['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            throw new Exception($GLOBALS['actor-form-exception-image']);
        }

        /*// Le type doit être un entier entre 0 et 3 (0: unknown, 1: actor, 2: director, 3: composer)
        $data['type'] = htmlspecialchars(trim($data['type']));
        if (!ctype_digit($data['type']) || $data['type'] < 0 || $data['type'] > 3) {
            throw new Exception($GLOBALS['actor-form-exception-type']);
        }*/
    }
}
