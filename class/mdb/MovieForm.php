<?php

namespace mdb;

use Exception;

class MovieForm
{
    const POSTER_DIR = 'uploads/posters/';

    public function getForm(): string
    {
        $tagDB = new TagDB();
        $categories = $tagDB->getTags();

        $html = "<h2>Ajouter un Nouveau Film Manuellement</h2>
            <form method='POST' enctype='multipart/form-data'>
                <div> 
                    <label for='title'>Titre</label>
                    <input type='text' name='title' id='title' required>
                </div>
                <div> 
                    <label for='release_date'>Date de Sortie</label>
                    <input type='date' name='release_date' id='release_date' required>
                </div>
                <div> 
                    <label for='duration'>Durée</label>
                    <input type='number' name='duration' id='duration' required>
                </div>
                <div> 
                    <label for='posters'>Affiche</label>
                    <div id='posters-preview'><img src='' alt=''></div>
                    <input type='file' name='posters' id='posters' required accept='image/jpeg, image/jpg, image/png'>
                </div>
                <div> 
                    <label for='synopsis'>Synopsis</label>
                    <textarea name='synopsis' id='synopsis' required></textarea>
                </div>
                <div> 
                    <label for='trailer'>Bande Annonce</label>
                    <input type='text' name='trailer' id='trailer' required>
                </div>
                <div> 
                    <label for='category'>Catégories</label>
                    <div id = 'categories'>";
        foreach ($categories as $category) {
            $html .= "<div>
                        <input type='checkbox' name='category[]' id='category_" . $category->getId() . "' value='" . $category->getId() . "'>
                        <label for='category_" . $category->getId() . "'>" . $category->getName() . "</label>
                      </div>";
        }
        $html .= "</div>
                    <div>
                      <input type='text' id='newCategory' placeholder='Nouveau tag'>
                      <button type='button' id='addCategory'>Ajouter Tag</button>
                  </div>
                </div>
                <div> 
                    <label for='age_limit'>Limite d'Age</label>
                    <select name='age_limit' id='age_limit' required>
                        <option value=''>-- Choisir une limite d'âge --</option>
                        <option value='1'>Tout Public</option>
                        <option value='10'>10 ans et +</option>
                        <option value='12'>12 ans et +</option>
                        <option value='16'>16 ans et +</option>
                        <option value='18'>18 ans et +</option>
                    </select>
                </div>
                <div>
                    <label for='seen'>Vu</label>
                    <input type='checkbox' name='seen' id='seen'>
                </div>
                <div> 
                    <button type='submit'>Ajouter</button>
                    <button type='reset'>Annuler</button>
                </div>
            </form>
            <script src=" . $GLOBALS['JS_DIR'] . "MovieForm.js" . "></script>";

        return $html;
    }

    /**
     * @throws Exception
     */
    public function createMovie(array $data, $img_file): void
    {
        // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
        $data['title'] = htmlspecialchars(trim($data['title']));
        if (empty($data['title']) || strlen($data['title']) < 3 || strlen($data['title']) > 50) { throw new Exception('Le titre doit contenir entre 3 et 50 caractères'); }

        // La date de sortie ne doit pas être vide, et doit être au format YYYY-MM-DD
        $data['release_date'] = htmlspecialchars(trim($data['release_date']));
        if (empty($data['release_date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['release_date'])) { throw new Exception('La date de sortie doit être au format YYYY-MM-DD'); }

        // La durée (en minutes) ne doit pas être vide, et doit être un entier positif
        $data['duration'] = htmlspecialchars(trim($data['duration']));
        if (empty($data['duration']) || !ctype_digit($data['duration']) || $data['duration'] <= 0) { throw new Exception('La durée doit être un entier positif'); }

        // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        if (empty($img_file['name']) || !in_array($img_file['type'], ['image/jpeg', 'image/jpg', 'image/png']))
        { throw new Exception('L\'affiche doit être une image (jpg, jpeg, png)'); }

        // Le synopsis ne doit pas être vide, et doit contenir entre 10 et 500 caractères
        $data['synopsis'] = htmlspecialchars(trim($data['synopsis']));
        if (empty($data['synopsis']) || strlen($data['synopsis']) < 10 || strlen($data['synopsis']) > 500) { throw new Exception('Le synopsis doit contenir entre 10 et 500 caractères'); }

        // La bande annonce ne doit pas être vide, et doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)
        $data['trailer'] = htmlspecialchars(trim($data['trailer']));
        if (empty($data['trailer']) || !filter_var($data['trailer'], FILTER_VALIDATE_URL) || !preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|dailymotion\.com|vimeo\.com)\/.+$/', $data['trailer']))
        { throw new Exception('La bande annonce doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)'); }

        // La liste des catégories doit contenir au moins un élément
        if (empty($data['category'])) { throw new Exception('Le film doit appartenir à au moins une catégorie'); }

        // La limite d'âge ne doit pas être vide, et doit être un entier positif entre 0 et 18
        $data['age_limit'] = htmlspecialchars(trim($data['age_limit']));
        if (empty($data['age_limit']) || !ctype_digit($data['age_limit']) || $data['age_limit'] < 0 || $data['age_limit'] > 18) { throw new Exception('La limite d\'âge doit être un entier positif entre 0 et 18'); }

        // Vu doit être un booléen. Si la date de sortie est supérieure à la date actuelle, vu doit être faux
        $data['seen'] = isset($data['seen']);
        if ($data['seen'] && $data['release_date'] > date('Y-m-d')) { $data['seen'] = false; }

        // Save movie to database
        try { $data['posters'] = $this->savePoster($img_file); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }
        $movie_id = $this->saveMovie($data);
        if ($movie_id === 0)  { throw new Exception('Erreur lors de l\'ajout du film dans la base de données'); }
        else { $this->saveCategories($data['category'], $movie_id); }
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
        if (!$uploaded) { throw new Exception('Erreur lors de l\'upload de l\'affiche'); }
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
}