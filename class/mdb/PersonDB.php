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
    public function advancedPersonSearch($firstName, $lastName, $birthDate, $deathDate, $firsNameOperator, $lastNameOperator, $birthDateOperator, $deathDateOperator, $otherPerson, $otherPersonOperator, $tags, $tagsOperator): array
    {
        $firstQuery = "SELECT p.id, mp.movie_id FROM person p
                LEFT JOIN movie_person mp ON p.id = mp.person_id
              WHERE p.first_name " . $firsNameOperator . " :firstName
              AND p.last_name " . $lastNameOperator . " :lastName
              AND p.birth_date " . $birthDateOperator . " :birthDate";

        $params = array(
            ':firstName' => "%" . $firstName . "%",
            ':lastName' => "%" . $lastName . "%",
            ':birthDate' => $birthDate,
        );

        if ($deathDate != "0000-00-00")
        {
            $firstQuery .= " AND p.death_date " . $deathDateOperator . " :deathDate";
            $params[':deathDate'] = $deathDate;
        }

        $Ids = $this->execute($firstQuery, $params);

        // Pour chaque film de qhaque personne, on vérifie si les autres personnes sont dans le film et si les tags sont présents
        $filteredPerson = array();
        $tagDB = new TagDB();
        foreach ($Ids as $id)
        {
            if (in_array($id->id, $filteredPerson)) { continue; }

            $personOnMovie = $this->getPersonOfMovie($id->movie_id);
            $personOnMovie = array_column($personOnMovie, 'id');
            $nbPersonMatch = count(array_intersect($personOnMovie, $otherPerson));

            $tagsOnMovie = $tagDB->getTagsOfMovie($id->movie_id);
            $tagsOnMovie = array_column($tagsOnMovie, 'id');
            $nbTagsMatch = count(array_intersect($tagsOnMovie, $tags));

            if ($otherPersonOperator == "AND" && $nbPersonMatch == count($otherPerson) || $otherPersonOperator == "OR" && $nbPersonMatch > 0)
            {
                if ($tagsOperator == "AND" && $nbTagsMatch == count($tags) || $tagsOperator == "OR" && $nbTagsMatch > 0)
                {
                    $filteredPerson[] = $id->id;
                }
            }
        }
        return $filteredPerson;
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
    public function getPersonOfMovie($movieId): bool|array
    {
        $query = "SELECT DISTINCT p.id
              FROM movie_person mp
              INNER JOIN person p ON mp.person_id = p.id
              WHERE mp.movie_id = :movieId";
        return $this->execute($query, array(':movieId' => $movieId));
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
    public function alterPersonReturnID($id, $first_name, $last_name, $birth_date, $death_date, $image_path): bool|int
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
        if (!empty($this->execute($query, $params, NULL))) { return $id; }
        return 0;
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
    public function deleteMoviePersonByAll($movieId,$personId, $type): array
    {
        $query = "DELETE FROM movie_person WHERE person_id = :personId AND person_type = :type AND movie_id = :movieId";
        $params = [':personId' => $personId, ':type' => $type, ':movieId' => $movieId];
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