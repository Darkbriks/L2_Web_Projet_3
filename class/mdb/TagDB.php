<?php

namespace mdb;

use Exception;
use pdo_wrapper\PdoWrapper;

class TagDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    /**
     * @throws Exception
     */
    public function getData($attributes, $values, $and = true, $limit = 10, $order = 'id', $direction = 'ASC', $useLike = false, $table='Tag', $class_name=null): bool|array
    {
        return parent::getData($attributes, $values, $and, $limit, $order, $direction, $useLike, $table, "mdb\data_template\Tag");
    }

    public function tagExist($name): bool
    {
        $sql = "SELECT * FROM tag WHERE name = :name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => $name]);
        return $stmt->fetch() !== false;
    }

    /**
     * @throws Exception
     */
    public function getTags(): array
    {
        return $this->execute("SELECT * FROM tag", null, "mdb\data_template\Tag");
    }

    /**
     * @throws Exception
     */
    public function getTag($id): array
    {
        return $this->execute("SELECT * FROM tag WHERE id = ?", $id, "mdb\data_template\Tag");
    }

    /**
     * @throws Exception
     */
    public function getTagByName($name): array
    {
        return $this->execute("SELECT * FROM tag WHERE name = ?", $name, "mdb\data_template\Tag");
    }

    /**
     * @throws Exception
     */
    public function addTag($name): int
    {
        if ($this->tagExist($name)) { throw new Exception($GLOBALS['tag-db-already-exists']); }

        $sql = "INSERT INTO tag (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute([':name' => $name])) { return $this->pdo->lastInsertId(); }
        return 0;
    }

    /**
     * @throws Exception
     */
    public function getTagsOfMovie($movieId): array
    {
        $query = "SELECT tag.* FROM tag JOIN movie_tag mt ON tag.id = mt.tag_id WHERE mt.movie_id = :movieId";
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Tag");
    }

    /**
     * @throws Exception
     */
    public function addMovie_Tag($movie_id, $tag_id): array
    {
        $query = "INSERT INTO movie_tag (movie_id, tag_id) VALUES (:movie_id, :tag_id)";
        return $this->execute($query, array(':movie_id' => $movie_id, ':tag_id' => $tag_id), NULL);
    }

    /**
     * @throws Exception
     */
    public function alterTag($id, $name): array
    {
        $query = "UPDATE tag SET name = :name WHERE id = :id";
        $params = array(':id' => $id, ':name' => $name);
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function alterTag_($tag_alter , $tag_alter_value, $tag_id) : array
    {
        $query = "UPDATE tag SET" . $tag_alter . "= :tag_alter WHERE id = :id";
        return $this->execute($query,array(':tag_alter' => $tag_alter_value,':id' => $tag_id),NULL);
    }

    /**
     * Suppression d'un tag par ID
     * @throws Exception
     */
    public function deletePersonById($id): array
    {
        $query = "DELETE FROM tag WHERE id = :id";
        $params = [':id' => $id];
        return $this->execute($query, $params, NULL);
    }

    /**
     * Suppression des relations dans movie_tag par ID du tag
     * @throws Exception
     */
    public function deleteMovieTagByTagId($tag_id): array
    {
        $query = "DELETE FROM movie_tag WHERE tag_id = :tag_id";
        $params = [':tag_id' => $tag_id];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteTagAndRelationsById($id): array
    {
        $this->deleteMovieTagByTagId($id);
        return $this->deletePersonById($id);
    }
}