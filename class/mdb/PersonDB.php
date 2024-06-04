<?php

namespace mdb;

use Exception;
use pdo_wrapper\PdoWrapper;

class PersonDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    /**
     * @throws Exception
     */
    public function getData($attributes, $values, $and = true, $limit = 10, $order = 'id', $direction = 'ASC', $useLike = false, $table='person', $class_name=null): bool|array
    {
        return parent::getData($attributes, $values, $and, $limit, $order, $direction, $useLike, $table, "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function addPerson($first_name, $last_name, $birth_date, $death_date, $image_path): bool
    {
        $checkSql = "SELECT COUNT(*) FROM person WHERE first_name = :first_name AND last_name = :last_name AND birth_date = :birth_date";
        $stmt = $this->pdo->prepare($checkSql);
        $stmt->execute([':first_name' => $first_name, ':last_name' => $last_name, ':birth_date' => $birth_date]);

        if ($stmt->fetchColumn() > 0) {  throw new Exception($GLOBALS['person-db-already-exists']); }

        $sql = "INSERT INTO person (first_name, last_name, birth_date, death_date ,image_path) VALUES (:first_name, :last_name, :birth_date, :death_date, :image_path)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':birth_date' => $birth_date,
            ':death_date' => $death_date,
            ':image_path' => $image_path
        ]);
    }

    /**
     * @throws Exception
     */
    public function addPersonAndReturnId($first_name, $last_name, $birth_date, $death_date, $image_path): bool|int|string
    {
        if ($this->addPerson($first_name, $last_name, $birth_date, $death_date, $image_path)) { return $this->pdo->lastInsertId(); }
        return 0;
    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function addListOfMovie_Person($list): bool
    {
        foreach ($list as $person)
        {
            if(!$this->addMovie_Person($person['movie_id'],$person['person_id'],$person['played_name'],$person['person_type'])) { return false; }
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public function addMovie_Director($movie_id, $director_id): bool
    {
        return$this->addMovie_Person($movie_id, $director_id, '', 2);
    }

    /**
     * @throws Exception
     */
    public function addListOfMovie_Director($list): bool
    {
        foreach ($list as $director)
        {
            if(!$this->addMovie_Director($director['movie_id'], $director['director_id'])) { return false; }
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public function addMovie_Composer($movie_id, $composer_id): bool
    {
        return $this->addMovie_Person($movie_id, $composer_id, '', 3);
    }

    /**
     * @throws Exception
     */
    public function addListOfMovie_Composer($list): bool
    {
        foreach ($list as $composer)
        {
            if(!$this->addMovie_Composer($composer['movie_id'], $composer['composer_id'])) { return false; }
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public function getPersons(): bool|array
    {
        return $this->execute("SELECT * FROM person", null, "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getActors(): bool|array
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 1";

        return $this->execute($query, null, "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getComposers(): bool|array
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 3";

        return $this->execute($query, null, "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getDirectors(): bool|array
    {
        $query = "SELECT DISTINCT p.* 
                  FROM person p
                  INNER JOIN movie_person mp ON p.id = mp.person_id
                  WHERE mp.person_type = 2";

        return $this->execute($query, null, "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getPersonById($id): bool|array
    {
        return $this->execute("SELECT * FROM person WHERE id = :id", ["id" => $id], "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getActorsOfMovie($movieId): bool|array
    {
        $query = "SELECT p.*, mp.played_name 
              FROM movie_person mp
              INNER JOIN person p ON mp.person_id = p.id
              WHERE mp.movie_id = :movieId AND mp.person_type = 1";
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getDirectorsOfMovie($movieId): bool|array
    {
        $query = "SELECT p.* 
              FROM movie_person mp
              INNER JOIN person p ON mp.person_id = p.id
              WHERE mp.movie_id = :movieId AND mp.person_type = 2";
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getComposersOfMovie($movieId): bool|array
    {
        $query = "SELECT p.* 
              FROM movie_person mp
              INNER JOIN person p ON mp.person_id = p.id
              WHERE mp.movie_id = :movieId AND mp.person_type = 3";
        return $this->execute($query, array(':movieId' => $movieId), "mdb\data_template\Person");
    }

    /**
     * @throws Exception
     */
    public function getMoviesOfPerson($personId, $personType): bool|array
    {
        $query = "SELECT m.* 
              FROM movie_person mp
              INNER JOIN movies m ON mp.movie_id = m.id
              WHERE mp.person_id = :personId AND mp.person_type = :personType";

        return $this->execute($query, array(':personId' => $personId, ':personType' => $personType), "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function alterPerson($id, $first_name, $last_name, $birth_date, $death_date, $image_path): array
    {
        $query = "UPDATE person SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, death_date = :death_date, image_path = :image_path WHERE id = :id";
        $params = array(
            ':id' => $id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':birth_date' => $birth_date,
            ':death_date' => $death_date,
            ':image_path' => $image_path
        );
        return $this->execute($query, $params, NULL);
    }


    /**
     * @throws Exception
     */
    public function alterPerson_($person_alter ,$person_alter_value, $person_id): bool|array
    {
        $query = "UPDATE person SET" . $person_alter . "= :person_alter WHERE id = :id";
        return $this->execute($query,array(':person_alter' => $person_alter_value,':id' => $person_id),NULL);
    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function getPersonsBy_Order($condition, $order): array
    {
        $order = ($order) ? "ASC" : "DESC";
        $query = "SELECT * FROM person ORDER BY " . $condition. $order;

        return $this->execute($query,NULL, "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function deletePersonById($id): array
    {
        $query = "DELETE FROM person WHERE id = :id";
        $params = [':id' => $id];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteMoviePersonByPersonId($personId): array
    {
        $query = "DELETE FROM movie_person WHERE person_id = :personId";
        $params = [':personId' => $personId];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deletePersonAndRelationsById($id): array
    {
        $this->deleteMoviePersonByPersonId($id);
        return $this->deletePersonById($id);
    }
}