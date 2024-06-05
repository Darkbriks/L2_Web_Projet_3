<?php

namespace mdb;

use Exception;
use pdo_wrapper\PdoWrapper;

class MoviesDB extends PdoWrapper
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        try { parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']); }
        catch (Exception $e) { throw new Exception($e->getMessage(), (int)$e->getCode()); }
    }

    /**
     * @throws Exception
     */
    public function getRandomMovie() : array
    {
        return $this->execute("SELECT * FROM movies ORDER BY RAND() LIMIT 1",NULL,"mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function getData($attributes, $values, $and = true, $limit = 10, $order = 'id', $direction = 'ASC', $useLike = false, $table='movies', $class_name=null): bool|array
    {
        return parent::getData($attributes, $values, $and, $limit, $order, $direction, $useLike, $table, "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function advancedMovieSearch($title, $titleOperator, $release, $releaseOperator, $duration, $durationOperator, $rating, $ratingOperator, $note, $noteOperator, $seen, $synopsis, $synopsisOperator, $directors, $directorsOperator, $actors, $actorsOperator, $composers, $composersOperator, $tags, $tagsOperator): array
    {
        $query = "SELECT m.id, mp.person_type, mp.person_id, mt.tag_id FROM movies m LEFT JOIN movie_person mp ON m.id = mp.movie_id LEFT JOIN person p ON mp.person_id = p.id LEFT JOIN movie_tag mt ON m.id = mt.movie_id LEFT JOIN tag t ON mt.tag_id = t.id
              WHERE m.title " . $titleOperator . " :title AND m.release_date " .  $releaseOperator . " :release AND m.time_duration " . $durationOperator . " :duration AND m.rating " . $ratingOperator . " :rating AND m.note " . $noteOperator . " :note AND m.synopsis " . $synopsisOperator . " :synopsis";
        $params = array(':title' => "%" . $title . "%", ':release' => $release, ':duration' => $duration, ':rating' => $rating, ':note' => $note, ':synopsis' => "%" . $synopsis . "%");
        if ($seen != -1) { $query .= " AND m.vu = :seen"; $params[':seen'] = $seen; }
        $res = $this->execute($query, $params, "mdb\data_template\AdvancedMovieSearch");

        $directorsDict = array();
        foreach ($res as $movie)
        {
            if ($movie->getPersonType() != 2) { continue; }
            if (!isset($directorsDict[$movie->getId()])) { $directorsDict[$movie->getId()] = array(); }
            if (!in_array($movie->getPersonId(), $directorsDict[$movie->getId()])) { $directorsDict[$movie->getId()][] = $movie->getPersonId(); }
        }

        $actorsDict = array();
        foreach ($res as $movie)
        {
            if ($movie->getPersonType() != 1) { continue; }
            if (!isset($actorsDict[$movie->getId()])) { $actorsDict[$movie->getId()] = array(); }
            if (!in_array($movie->getPersonId(), $actorsDict[$movie->getId()])) { $actorsDict[$movie->getId()][] = $movie->getPersonId(); }
        }

        $composersDict = array();
        foreach ($res as $movie)
        {
            if ($movie->getPersonType() != 3) { continue; }
            if (!isset($composersDict[$movie->getId()])) { $composersDict[$movie->getId()] = array(); }
            if (!in_array($movie->getPersonId(), $composersDict[$movie->getId()])) { $composersDict[$movie->getId()][] = $movie->getPersonId(); }
        }

        $tagsDict = array();
        foreach ($res as $movie)
        {
            if ($movie->getTagId() == null) { continue; }
            if (!isset($tagsDict[$movie->getId()])) { $tagsDict[$movie->getId()] = array(); }
            if (!in_array($movie->getTagId(), $tagsDict[$movie->getId()])) { $tagsDict[$movie->getId()][] = $movie->getTagId(); }
        }

        // Pour chaque film, on verifie si les directeurs, acteurs, compositeurs et tags correspondent aux filtres
        $filteredMovies = array();
        foreach ($res as $movie)
        {
            if (in_array($movie->getId(), $filteredMovies)) { continue; }

            $directorsMatch = 0;
            $actorsMatch = 0;
            $composersMatch = 0;
            $tagsMatch = 0;

            foreach ($directors as $director) { if (in_array($director, $directorsDict[$movie->getId()])) { $directorsMatch++; } }
            foreach ($actors as $actor) { if (in_array($actor, $actorsDict[$movie->getId()])) { $actorsMatch++; } }
            foreach ($composers as $composer) { if (in_array($composer, $composersDict[$movie->getId()])) { $composersMatch++; } }
            foreach ($tags as $tag) { if (in_array($tag, $tagsDict[$movie->getId()])) { $tagsMatch++; } }

            if (($directorsOperator == "AND" && $directorsMatch == count($directors)) || ($directorsOperator == "OR" && $directorsMatch > 0))
            {
                if (($actorsOperator == "AND" && $actorsMatch == count($actors)) || ($actorsOperator == "OR" && $actorsMatch > 0))
                {
                    if (($composersOperator == "AND" && $composersMatch == count($composers)) || ($composersOperator == "OR" && $composersMatch > 0))
                    {
                        if (($tagsOperator == "AND" && $tagsMatch == count($tags)) || ($tagsOperator == "OR" && $tagsMatch > 0))
                        {
                            $filteredMovies[] = $movie->getId();
                        }
                    }
                }
            }
        }
        return $filteredMovies;
    }

    /**
     * @throws Exception
     */
    private function addMovie($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating): bool
    {
        $checkSql = "SELECT COUNT(*) FROM movies WHERE title = :title";
        $stmt = $this->pdo->prepare($checkSql);
        $stmt->execute([':title' => $title]);
        if ($stmt->fetchColumn() > 0) { throw new Exception($GLOBALS['movie-db-already-exists']); }

        $sql = "INSERT INTO movies (title, release_date, synopsis, vu, image_path, time_duration, note, trailer_path, rating) VALUES (:title, :release_date, :synopsis, :vu, :image_path, :time_duration, :note, :trailer_path, :rating)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':title' => $title, ':release_date' => $release_date, ':synopsis' => $synopsis, ':vu' => $vu, ':image_path' => $image_path, ':time_duration' => $time_duration, ':note' => $note, ':trailer_path' => $trailer_path, ':rating' => $rating]);
    }

    /**
     * @throws Exception
     */
    public function addMovieAndReturnId($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating): int
    {
        if ($this->addMovie($title, $release_date, $synopsis, $vu, $image_path, $time_duration, $note, $trailer_path, $rating))
        {
            return $this->pdo->lastInsertId();
        }
        return 0;
    }

    /**
     * @throws Exception
     */
    public function getMovies(): array
    {
        return $this->execute("SELECT * FROM movies", null, "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function getMovieById($id): array
    {
        return $this->execute("SELECT * FROM movies WHERE id = :id", ["id" => $id], "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function getMoviesByTag($tag): array
    {
        $query = "SELECT  m.* FROM movies m
              JOIN movie_tag mt ON m.id = mt.movie_id
              JOIN tag ON mt.tag_id = tag.id
              WHERE tag.id = :tag";

        return $this->execute($query, array(':tag' => $tag), "mdb\data_template\Movie");
    }

    /**
     * @throws Exception
     */
    public function setSeen($id, $seen): void
    {
        $query = "UPDATE movies SET vu = :seen WHERE id = :id";
        $this->execute($query, array(':seen' => $seen, ':id' => $id), NULL);
    }

    /**
     * @throws Exception
     */
    public function alterMovie_($movie_alter ,$movie_alter_value, $movie_id): bool|array
    {
        $query = "UPDATE movies SET" . $movie_alter . "= :movie_alter WHERE id = :id";
        return $this->execute($query,array(':movie_alter' => $movie_alter_value,':id' => $movie_id),NULL);
    }

    /**
     * @throws Exception
     */
    public function alterMovie($movie_id, $title, $release_date, $synopsis, $image_path, $time_duration, $note, $rating, $trailer_path): bool|array
    {
        $query = "UPDATE movies SET title = :title, release_date = :release_date, synopsis = :synopsis, image_path = :image_path, time_duration = :time_duration, note = :note, rating = :rating, trailer_path = :trailer_path WHERE id = :id";

        $params = array(
            ':title' => $title,
            ':release_date' => $release_date,
            ':synopsis' => $synopsis,
            ':image_path' => $image_path,
            ':time_duration' => $time_duration,
            ':note' => $note,
            ':rating' => $rating,
            ':trailer_path' => $trailer_path,
            ':id' => $movie_id
        );

        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteMovieById($id): array
    {
        $query = "DELETE FROM movies WHERE id = :id";
        $params = [':id' => $id];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteMoviePersonByMovieId($movieId): array
    {
        $query = "DELETE FROM movie_person WHERE movie_id = :movieId";
        $params = [':movieId' => $movieId];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteMovieTagByMovieId($movieId): array
    {
        $query = "DELETE FROM movie_tag WHERE movie_id = :movieId";
        $params = [':movieId' => $movieId];
        return $this->execute($query, $params, NULL);
    }

    /**
     * @throws Exception
     */
    public function deleteMovieAndRelationsById($id): array
    {
        $this->deleteMoviePersonByMovieId($id);
        $this->deleteMovieTagByMovieId($id);
        return $this->deleteMovieById($id);
    }
}