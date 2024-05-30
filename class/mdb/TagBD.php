<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class TagBD extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    public function tagExist($name): bool
    {
        $sql = "SELECT * FROM tag WHERE name = :name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        return $stmt->fetch() !== false;
    }

    public function getTags(): array
    {
        return $this->execute("SELECT * FROM tag", null, "mdb\data_template\Tag");
    }

    public function getTag($id): array
    {
        return $this->execute("SELECT * FROM tag WHERE id = ?", $id, "mdb\data_template\Tag");
    }

    public function getTagByName($name): array
    {
        return $this->execute("SELECT * FROM tag WHERE name = ?", $name, "mdb\data_template\Tag");
    }

    public function addTag($name): bool
    {
        // Requête SQL pour insérer un nouveau tag
        $sql = "INSERT INTO tag (name) VALUES (:name)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([':name' => $name]);
    }
}