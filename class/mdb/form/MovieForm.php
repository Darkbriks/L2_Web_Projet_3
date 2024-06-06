<?php

namespace mdb\form;

use Exception;
use mdb\MoviesDB;
use mdb\PersonDB;
use mdb\TagDB;

class MovieForm
{
    /**
     * @throws Exception
     */
    public function Movie(array $data, $img_file, $movie_id = null): void
    {
        $this->checkForm($data, $img_file);

        // Save movie to database
        try { $data['posters'] = ValidateForm::saveImage($img_file, 'uploads/posters/'); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }
        $movieDB = new MoviesDB();

        if($movie_id === null){
            $data['seen'] = (isset($data['seen'])) ? $data['seen'] : 0;
            $movie_id =  $movieDB->addMovieAndReturnId($data['title'], $data['release_date'], $data['synopsis'], $data['seen'], $data['posters'], $data['duration'], -1, $data['trailer'], $data['age_limit']);
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
        else{
            $movieDB->alterMovie($movie_id, $data['title'], $data['release_date'], $data['synopsis'], $data['posters'], $data['duration'], $data['note'], $data['age_limit'], $data['trailer']);
        }
    }

    /**
     * @throws Exception
     */
    private function addMovie(array $data): int
    {
        $movieDB = new MoviesDB();
        return $movieDB->addMovieAndReturnId($data['title'], $data['release_date'], $data['synopsis'], $data['seen'], $data['posters'], $data['duration'], -1, $data['trailer'], $data['age_limit']);
    }

    /**
     * @throws Exception
     */
    private function saveMovie(array $data, $movie_id): void
    {
        $movieDB = new MoviesDB();
        $movieDB->alterMovie($movie_id, $data['title'], $data['release_date'], $data['synopsis'], $data['posters'], $data['duration'], $data['note'], $data['age_limit'], $data['trailer']);
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

    /**
     * @throws Exception
     */
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
    private function checkForm(array $data, $img_file, $alter = false): void
    {
        $data = ValidateForm::convertData($data);
        if (!$alter) {
            $data['seen'] = (isset($data['seen'])) ? $data['seen'] : 0;
        }

        ValidateForm::validateTextInput($data['title'], $GLOBALS['movie-form-exception-title']);
        ValidateForm::validateDateInput($data['release_date'], $GLOBALS['movie-form-exception-release-date']);
        ValidateForm::validateNumberInput($data['duration'], $GLOBALS['movie-form-exception-duration'], 1);
        ValidateForm::validateImageInput($img_file, $GLOBALS['movie-form-exception-poster']);
        ValidateForm::validateTextInput($data['synopsis'], $GLOBALS['movie-form-exception-synopsis'], 10, 500);
        ValidateForm::validateTextInput($data['age_limit'], $GLOBALS['movie-form-exception-age-rating'], 1, 2);
        ValidateForm::validateNumberInput($data['age_limit'], $GLOBALS['movie-form-exception-age-rating'], 0, 18);

        // La bande annonce ne doit pas être vide, et doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)
        $data['trailer'] = htmlspecialchars(trim($data['trailer']));
        if (empty($data['trailer']) || !filter_var($data['trailer'], FILTER_VALIDATE_URL) || !preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|dailymotion\.com|vimeo\.com)\/.+$/', $data['trailer'])) {
            throw new Exception($GLOBALS['movie-form-exception-trailer']);
        }
        if (!$alter) {
            if ($data['seen'] && $data['release_date'] > date('Y-m-d')) {
                throw new Exception($GLOBALS['movie-form-exception-seen']);
            }
        }
    }
}
