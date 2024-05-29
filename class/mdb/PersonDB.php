<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class PersonDB extends PdoWrapper
{

    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }
    public function getActors()
    {
        return $this->execute("SELECT * FROM person", null, "mdb\data_template\Person");
    }

    public function getPersonById($id)
    {
        return $this->execute("SELECT * FROM person WHERE id = :id", ["id" => $id], "mdb\data_template\Person");
    }

    public function getActorsOfMovie($movieId)
    {
        // Requête pour obtenir les acteurs et les personnages qu'ils ont joués dans un film spécifique
        $query = "SELECT p.*, ma.played_name
              FROM movie_actor ma
              INNER JOIN person p ON ma.actor_id = p.id
              WHERE ma.movie_id = :movieId";

        // Exécution de la requête avec le paramètre :movieId
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");

    }

    public function getDirectorOfMovie($movieId)
    {
        // Requête pour obtenir le directeur d'un film spécifique
        $query = "SELECT p.*
              FROM movie_director md
              INNER JOIN person p ON md.director_id = p.id
              WHERE md.movie_id = :movieId";

        // Exécution de la requête avec le paramètre :movieId
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

}