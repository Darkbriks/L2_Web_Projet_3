<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class LinkBD extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    /*
     * Link a person to a movie
     */
    public function addMovie_Person($movieId, $personId, $playedName, $personType): bool
    {
        $query = "INSERT INTO movie_person (movie_id, person_id, played_name, person_type)
              VALUES (:movieId, :personId, :playedName, :personType)";
        $params = array(
            ':movieId' => $movieId,
            ':personId' => $personId,
            ':playedName' => $playedName,
            ':personType' => $personType
        );
        return $this->execute($query, $params);
    }

    /*
     * Link a list of persons to a movie
     */
    public function addListOfMovie_Person($list): bool
    {
        foreach ($list as $person)
        {
            if(!$this->addMovie_Person($person['movie_id'],$person['person_id'],$person['played_name'],$person['person_type'])) { return false; }
        }
        return true;
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

    /*
     * Link a director to a movie
     */
    public function addMovie_Director($movie_id, $director_id): bool
    {
        return$this->addMovie_Person($movie_id, $director_id, '', 2);
    }

    /*
     * Link a list of directors to a movie
     */
    public function addListOfMovie_Director($list): bool
    {
        foreach ($list as $director)
        {
            if(!$this->addMovie_Director($director['movie_id'], $director['director_id'])) { return false; }
        }
        return true;
    }

    /*
     * Link a music composer to a movie
     */
    public function addMovie_Composer($movie_id, $composer_id): bool
    {
        return $this->addMovie_Person($movie_id, $composer_id, '', 3);
    }

    /*
     * Link a list of music composers to a movie
     */
    public function addListOfMovie_Composer($list): bool
    {
        foreach ($list as $composer)
        {
            if(!$this->addMovie_Composer($composer['movie_id'], $composer['composer_id'])) { return false; }
        }
        return true;
    }
}