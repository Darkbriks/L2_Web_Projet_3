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
    public function getMoviesByActor($firstName, $lastName): array
    {
        $query = "SELECT m.id, m.title FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 1";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName));
    }

    /*
     * Get all movies with a specified director
     */
    public function getMoviesByDirector($firstName, $lastName): array
    {
        $query = "SELECT  m.id, m.title FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 2";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName));
    }

    /*
     * Get all movies with a specified composer
     */
    public function getMoviesByComposer($firstName, $lastName): array
    {
        $query = "SELECT m.id, m.title FROM movies m
              JOIN movie_person mp ON m.id = mp.movie_id
              JOIN person p ON mp.person_id = p.id
              WHERE p.first_name = :firstName AND p.last_name = :lastName AND mp.person_type = 3";

        return $this->execute($query, array(':firstName' => $firstName, ':lastName' => $lastName));
    }

    /*
     * Get all movies with minimum rating
     */
    public function getMoviesByMinRating($minRating): array
    {
        $query = "SELECT  id, title FROM movies WHERE rating >= :minRating";
        return $this->execute($query, array(':minRating' => $minRating));
    }

    /*
     * Get all movies with a specified rating
     */
    public function getMoviesByEqualRating($rating): array
    {
        $query = "SELECT id, title FROM movies WHERE rating = :rating";
        return $this->execute($query, array(':rating' => $rating));
    }
}