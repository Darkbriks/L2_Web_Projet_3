<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class MoviesDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    }

    public function addMovies($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating) {
        // Requête SQL pour insérer un nouveau film
        $sql = "INSERT INTO movies (title, release_date, synopsis, vu, image_path, time_duration, note, trailer_path, rating) 
                VALUES (:title, :release_date, :synopsis, :vu, :image_path, :time_duration, :note, :trailer_path, :rating)";

        // Préparer la requête
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        // Retourner true/false
        return $stmt->execute([
            ':title' => $title,
            ':release_date' => $release_date,
            ':synopsis' => $synopsis,
            ':vu' => $vu,
            ':image_path' => $image_path,
            ':time_duration' => $time_duration,
            ':note' => $note,
            ':trailer_path' => $trailer_path,
            ':rating' => $rating
        ]);
    }
    public function getMovies()
    {
        return $this->execute("SELECT * FROM movies", null, "mdb\data_template\Movie");
    }

    public function getMovieById($id)
    {
        return $this->execute("SELECT * FROM movies WHERE id = :id", ["id" => $id], "mdb\data_template\Movie");
    }

    public function getMovieByTitle($title)
    {
        return $this->execute("SELECT * FROM movies WHERE title = :title", ["title" => $title], "mdb\data_template\Movie");
    }
}