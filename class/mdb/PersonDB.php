<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class PersonDB extends PdoWrapper
{

    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }
    public function addPerson($first_name, $last_name, $birth_date, $death_date, $type, $image_path) {
        // Requête SQL pour insérer un nouveau film
        $sql = "INSERT INTO person (first_name, last_name, birth_date, death_date,image_path) 
                VALUES (:first_name, :last_name, :birth_date, :death_date,:image_path)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':birth_date' => $birth_date,
            ':death_date' => $death_date,
            ':image_path' => $image_path
        ]);
    }

    public function getPersons()
    {
        return $this->execute("SELECT * FROM person", null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les acteurs
    public function getActors()
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 1";

        return $this->execute($query, null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les compositeurs
    public function getComposers()
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 3";

        return $this->execute($query, null, "mdb\data_template\Person");
    }

    // Méthode pour obtenir uniquement les réalisateurs
    public function getDirectors()
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 2";

        return $this->execute($query, null, "mdb\data_template\Person");
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

    public function getDirectorsOfMovie($movieId)
    {
        $query = "SELECT p.* 
              FROM movie_person mp
              INNER JOIN person p ON mp.person_id = p.id
              WHERE mp.movie_id = :movieId AND mp.person_type = 2";
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

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