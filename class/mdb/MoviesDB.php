<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class MoviesDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    /*
     * Add a movie to the database
     */
    private function addMovie($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating): bool
    {
        $sql = "INSERT INTO movies (title, release_date, synopsis, vu, image_path, time_duration, note, trailer_path, rating) VALUES (:title, :release_date, :synopsis, :vu, :image_path, :time_duration, :note, :trailer_path, :rating)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':title' => $title, ':release_date' => $release_date, ':synopsis' => $synopsis, ':vu' => $vu, ':image_path' => $image_path, ':time_duration' => $time_duration, ':note' => $note, ':trailer_path' => $trailer_path, ':rating' => $rating]);
    }

    /*
     * Add a movie to the database and return its id. If the movie is not correctly added, return 0.
     */
    public function addMovieAndReturnId($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating): int
    {
        if ($this->addMovie($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating))
        {
            return $this->pdo->lastInsertId();
        }
        return 0;
    }

    /*
     * Get all movies from the database
     */
    public function getMovies(): array
    {
        return $this->execute("SELECT * FROM movies", null, "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified id
     */
    public function getMovieById($id): array
    {
        return $this->execute("SELECT * FROM movies WHERE id = :id", ["id" => $id], "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified title
     */
    public function getMovieByTitle($title): array
    {
        return $this->execute("SELECT * FROM movies WHERE title = :title", ["title" => $title], "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified actor
     */

    public function getMoviesIDByPerson($firstName, $lastName): array
    {
        $query = "SELECT m.id FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    public function getMoviesByPerson($firstName, $lastName): array
    {
        $query = "SELECT m.* FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    public function getMoviesIDByActor($firstName, $lastName): array
    {
        $query = "SELECT m.id FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 1";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    public function getMoviesByActor($firstName, $lastName): array
    {
        $query = "SELECT m.* FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 1";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified director
     */
    public function getMoviesIDByDirector($firstName, $lastName): array
    {
        $query = "SELECT  m.id, m.title FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 2";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    public function getMoviesByDirector($firstName, $lastName): array
    {
        $query = "SELECT  m.* FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 2";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified composer
     */
    public function getMoviesIDByComposer($firstName, $lastName): array
    {
        $query = "SELECT m.id FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 3";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    public function getMoviesByComposer($firstName, $lastName): array
    {
        $query = "SELECT m.id FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 3";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName), "mdb\data_template\Movie");
    }

    /*
     * Get all movies with minimum rating
     */
    public function getMoviesByMinRating($minRating): array
    {
        $query = "SELECT  id, title FROM movies WHERE rating >= :minRating";
        return $this->execute($query, array(':minRating' => $minRating), "mdb\data_template\Movie");
    }

    /*
     * Get all movies with a specified rating
     */
    public function getMoviesByEqualRating($rating): array
    {
        $query = "SELECT id, title FROM movies WHERE rating = :rating";
        return $this->execute($query, array(':rating' => $rating), "mdb\data_template\Movie");
    }

    public function getMoviesByTag($tag): array
    {
        $query = "SELECT  m.* FROM movies m
              JOIN movie_tag mt ON m.id = mt.movie_id
              JOIN tag ON mt.tag_id = tag.id
              WHERE tag.id = :tag";

        return $this->execute($query, array(':tag' => $tag), "mdb\data_template\Movie");
    }
    public function getMoviesBy($release_date = null, $duration = null, $name = null, $note = null, $rating = null, $synopsys): array
    {
        $query = "SELECT * FROM movies WHERE 1=1";
        $params = [];

        if ($release_date !== null) {
            $query .= " AND release_date = :release_date";
            $params[':release_date'] = $release_date;
        }

        if ($duration !== null) {
            $query .= " AND time_duration = :duration";
            $params[':duration'] = $duration;
        }

        if ($name !== null) {
            $query .= " AND title LIKE :name";
            $params[':name'] = '%' . $name . '%';
        }

        if ($note !== null) {
            $query .= " AND note = :note";
            $params[':rating'] = $note;
        }
        if($rating !== null){
            $query .= " AND rating = :rating";
            $params[':rating'] = $rating;
        }
        if($synopsys !== null){
            $query .= " AND synopsys LIKE :synopsys";
            $params[':synopsys'] = '%' . $synopsys . '%';
        }

        return $this->execute($query, $params, "mdb\data_template\Movie");
    }

    public function getMoviesBy_Order($condition, $order): array
    {
        $order = ($order) ? "ASC" : "DESC";
        $query = "SELECT * FROM movies ORDER BY " . $condition. $order;

        return $this->execute($query,NULL, "mdb\data_template\Movie");
    }

    public function alterMovie_($movie_alter ,$movie_alter_value, $movie_id)
    {
        $query = "UPDATE movies SET" . $movie_alter . "= :movie_alter WHERE id = :id";
        return $this->execute($query,array(':movie_alter' => $movie_alter_value,':id' => $movie_id),NULL);
    }



}