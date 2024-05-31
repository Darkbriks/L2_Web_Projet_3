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

    public function addTag($name): int
    {
        $sql = "INSERT INTO tag (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute([':name' => $name])) { return $this->pdo->lastInsertId(); }
        return 0;
    }

    public function getTagsOfMovie(int $movieId): array
    {
        $query = "SELECT tag.* 
              FROM tag
              JOIN movie_tag mt ON tag.id = mt.tag_id
              WHERE mt.movie_id = :movieId";

        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Tag");
    }

    /*
     * Link a movie to a tag.
     * When you add a tag to a movie, you have to add the tag to the tag table first.
     */
    public function addMovie_Tag($movie_id, $tag_id): bool
    {
        $sql = "INSERT INTO movie_tag (movie_id, tag_id) VALUES (:movie_id, :tag_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':movie_id' => $movie_id, ':tag_id' => $tag_id]);
    }

    /*
     * Link a list of tags to a movie
     */
    public function addListOfMovie_Tag($list): bool
    {
        foreach ($list as $tag) { if(!$this->addMovie_Tag($tag['movie_id'], $tag['tag_id'])) { return false; } }
        return true;
    }

}