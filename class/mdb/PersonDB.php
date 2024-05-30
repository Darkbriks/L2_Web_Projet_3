<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class PersonDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    public function addPerson($first_name, $last_name, $birth_date, $death_date, $type, $image_path): bool
    {
        $sql = "INSERT INTO person (first_name, last_name, birth_date, death_date, type ,image_path) VALUES (:first_name, :last_name, :birth_date, :death_date, :type,:image_path)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':first_name' => $first_name, ':last_name' => $last_name, ':birth_date' => $birth_date, ':type' => $type, ':death_date' => $death_date, ':image_path' => $image_path ]);
    }

    public function getPersons()
    {
        return $this->execute("SELECT * FROM person", null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les acteurs
    public function getActors()
    {
        return $this->execute("SELECT * FROM person WHERE type = 0 OR type = 1", null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les compositeurs
    public function getComposers()
    {
        return $this->execute("SELECT * FROM person WHERE type = 3", null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les réalisateurs
    public function getDirectors()
    {
        return $this->execute("SELECT * FROM person WHERE type = 0 OR type = 2", null, "mdb\data_template\Person");
    }
    public function getPersonById($id)
    {
        return $this->execute("SELECT * FROM person WHERE id = :id", ["id" => $id], "mdb\data_template\Person");
    }

    public function getActorsOfMovie($movieId)
    {
        $query = "SELECT p.*, mp.played_name 
                  FROM movie_person mp
                  INNER JOIN person p ON mp.person_id = p.id
                  WHERE mp.movie_id = :movieId AND mp.person_type = 1";

        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    // Obtenir les réalisateurs d'un film
    public function getDirectorsOfMovie($movieId)
    {
        $query = "SELECT p.* 
                  FROM movie_person mp
                  INNER JOIN person p ON mp.person_id = p.id
                  WHERE mp.movie_id = :movieId AND mp.person_type = 2";

        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    // Obtenir les compositeurs d'un film
    public function getComposersOfMovie($movieId)
    {
        $query = "SELECT p.* 
                  FROM movie_person mp
                  INNER JOIN person p ON mp.person_id = p.id
                  WHERE mp.movie_id = :movieId AND mp.person_type = 3";

        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    public function getMoviesOfPerson($personId, $personType)
    {
        $query = "SELECT m.* 
              FROM movie_person mp
              INNER JOIN movies m ON mp.movie_id = m.id
              WHERE mp.person_id = :personId AND mp.person_type = :personType";

        return $this->execute($query, array(':personId' => $personId, ':personType' => $personType), "mdb\data_template\Movie");
    }
}