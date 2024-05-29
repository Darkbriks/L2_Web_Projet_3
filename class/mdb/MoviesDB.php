<?php

namespace mdb;

use pdo_wrapper\PdoWrapper;

class MoviesDB extends PdoWrapper
{
    public function __construct()
    {
        parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
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