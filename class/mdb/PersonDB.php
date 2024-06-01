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

    public function addMovie_Person($movieId, $personId, $playedName, $personType=1): bool
    {
        $query = "INSERT INTO movie_person (movie_id, person_id, played_name, person_type)
              VALUES (:movieId, :personId, :playedName, :personType)";
        $params = array(
            ':movieId' => $movieId,
            ':personId' => $personId,
            ':playedName' => ($playedName == '') ? NULL : $playedName,
            ':personType' => $personType
        );
        $this->execute($query, $params);
        return true;
    }

    public function addListOfMovie_Person($list): bool
    {
        foreach ($list as $person)
        {
            if(!$this->addMovie_Person($person['movie_id'],$person['person_id'],$person['played_name'],$person['person_type'])) { return false; }
        }
        return true;
    }

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

    public function alterPerson_($person_alter ,$person_alter_value, $person_id)
    {
        $query = "UPDATE person SET" . $person_alter . "= :person_alter WHERE id = :id";
        return $this->execute($query,array(':person_alter' => $person_alter_value,':id' => $person_id),NULL);
    }

    public function getPersonsBy($alive = null, $type = null, $first_name = null,$last_name = null): array
    {
        $query = "SELECT * FROM person WHERE 1=1";
        $params = [];

        if ($alive !== null) {
            $query .= " AND death_date IS NULL";
        }

        if ($type !== null) {
            $query .= " AND time_duration = :type";
            $params[':type'] = $type;
        }

        if ($first_name !== null) {
            $query .= " AND first_name LIKE :first_name";
            $params[':first_name'] = '%' . $first_name . '%';
        }

        if ($last_name !== null) {
            $query .= " AND last_name LIKE :last_name";
            $params[':last_name'] = '%' . $last_name . '%';
        }

        return $this->execute($query, $params, "mdb\data_template\Movie");
    }

    public function getPersonsBy_Order($condition, $order): array
    {
        $order = ($order) ? "ASC" : "DESC";
        $query = "SELECT * FROM person ORDER BY " . $condition. $order;

        return $this->execute($query,NULL, "mdb\data_template\Movie");
    }

}