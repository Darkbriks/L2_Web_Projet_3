<?php

namespace mdb;

use Exception;

class MovieForm
{
    const POSTER_DIR = 'uploads/posters/';

    /**
     * @throws Exception
     */
    public function createMovie(array $data, $img_file): void
    {
        foreach ($data as $key => $value) { $data[$key] = htmlspecialchars(trim($value)); }

        $data['seen'] = (isset($data['seen'])) ? $data['seen'] : 0;
        $this->checkForm($data, $img_file);

        // Save movie to database
        try { $data['posters'] = $this->savePoster($img_file); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }
        $movie_id = $this->saveMovie($data);
        if ($movie_id === 0)  { throw new Exception($GLOBALS['movie-form-exception-adding']); }
        else { $this->saveCategories($data['category'], $movie_id); }


        if (isset($data['director']))
        {
            foreach ($data['director'] as $director)
            {
                $director = htmlspecialchars(trim($director));
                if (!empty($director)) { $this->linkPersons([$director], $movie_id, 2); }
            }
        }

        if (isset($data['actor']))
        {
            if (!isset($data['actor_role']) || count($data['actor']) !== count($data['actor_role'])) { throw new Exception($GLOBALS['movie-form-exception-actor-role']); }

            for ($i = 0; $i < count($data['actor']); $i++)
            {
                $actor = htmlspecialchars(trim($data['actor'][$i]));
                $role = htmlspecialchars(trim($data['actor_role'][$i]));
                if (!empty($actor)) { $this->linkPersons([$actor], $movie_id, 1, [$actor => $role]); }
            }
        }

        if (isset($data['composer']))
        {
            foreach ($data['composer'] as $composer)
            {
                $composer = htmlspecialchars(trim($composer));
                if (!empty($composer)) { $this->linkPersons([$composer], $movie_id, 3); }
            }
        }
    }

    /**
     * @throws Exception
     */
    private function savePoster(array $poster): string
    {
        $tmp_name = $poster['tmp_name'];
        $img_name = $poster['name'];
        $img_name = urldecode(htmlspecialchars($img_name));
        $dir = $GLOBALS['PHP_DIR'] . self::POSTER_DIR;
        if (!is_dir($dir)) { mkdir($dir); }
        $uploaded = move_uploaded_file($tmp_name, $dir . $img_name);
        if (!$uploaded) { throw new Exception($GLOBALS['movie-form-exception-upload']); }
        return $img_name;
    }

    private function saveMovie(array $data): int
    {
        $movieDB = new MoviesDB();
        return $movieDB->addMovieAndReturnId($data['title'], $data['release_date'], $data['synopsis'], $data['seen'], $data['posters'], $data['duration'], -1, $data['trailer'], $data['age_limit']);
    }

    private function saveCategories(array $categories, int $movie_id): void
    {
        $tagDB = new TagDB();
        foreach ($categories as $category)
        {
            $category = htmlspecialchars(trim($category));
            $tagDB->addMovie_Tag($movie_id, $category);
        }
    }

    private function linkPersons(array $persons, int $movie_id, int $type, array $roles=null): void
    {
        $personDB = new PersonDB();
        foreach ($persons as $person)
        {
            $person = htmlspecialchars(trim($person));
            $personDB->addMovie_Person($movie_id, $person, ($roles !== null) ? $roles[$person] : null, $type);
        }
    }

    /**
     * @throws Exception
     */
    private function checkForm(array $data, $img_file): void
    {
        // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
        $data['title'] = htmlspecialchars(trim($data['title']));
        if (empty($data['title']) || strlen($data['title']) < 3 || strlen($data['title']) > 50) { throw new Exception($GLOBALS['movie-form-exception-title']); }

        // La date de sortie ne doit pas être vide, et doit être au format YYYY-MM-DD
        $data['release_date'] = htmlspecialchars(trim($data['release_date']));
        if (empty($data['release_date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['release_date'])) { throw new Exception($GLOBALS['movie-form-exception-release-date']); }

        // La durée (en minutes) ne doit pas être vide, et doit être un entier positif
        $data['duration'] = htmlspecialchars(trim($data['duration']));
        if (empty($data['duration']) || !ctype_digit($data['duration']) || $data['duration'] <= 0) { throw new Exception($GLOBALS['movie-form-exception-duration']); }

        // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        if (empty($img_file['name']) || !in_array($img_file['type'], ['image/jpeg', 'image/jpg', 'image/png']))
        { throw new Exception($GLOBALS['movie-form-exception-poster']); }

        // Le synopsis ne doit pas être vide, et doit contenir entre 10 et 500 caractères
        $data['synopsis'] = htmlspecialchars(trim($data['synopsis']));
        if (empty($data['synopsis']) || strlen($data['synopsis']) < 10 || strlen($data['synopsis']) > 500) { throw new Exception($GLOBALS['movie-form-exception-synopsis']); }

        // La bande annonce ne doit pas être vide, et doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)
        $data['trailer'] = htmlspecialchars(trim($data['trailer']));
        if (empty($data['trailer']) || !filter_var($data['trailer'], FILTER_VALIDATE_URL) || !preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|dailymotion\.com|vimeo\.com)\/.+$/', $data['trailer']))
        { throw new Exception($GLOBALS['movie-form-exception-trailer']); }

        // La liste des catégories doit contenir au moins un élément
        if (empty($data['category'])) { throw new Exception($GLOBALS['movie-form-exception-tags']); }

        // La limite d'âge ne doit pas être vide, et doit être un entier positif entre 0 et 18
        $data['age_limit'] = htmlspecialchars(trim($data['age_limit']));
        if (empty($data['age_limit']) || !ctype_digit($data['age_limit']) || $data['age_limit'] < 0 || $data['age_limit'] > 18) { throw new Exception($GLOBALS['movie-form-exception-age-rating']); }

        // Vu doit être un booléen. Si la date de sortie est supérieure à la date actuelle, vu doit être faux
        if ($data['seen'] && $data['release_date'] > date('Y-m-d')) { throw new Exception($GLOBALS['movie-form-exception-seen']); }
    }
}