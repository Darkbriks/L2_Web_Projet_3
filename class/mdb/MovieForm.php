<?php

namespace mdb;

use Exception;

class MovieForm
{
    public function getForm(): string
    {
        $tagDB = new TagBD();
        $categories = $tagDB->getTags();

        $html = "<h2>Ajouter un Nouveau Film Manuellement</h2>
            <form method='POST'>
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
                    <label for='poster'>Affiche</label>
                    <div id='poster-preview'><img src='' alt=''></div>
                    <input type='file' name='poster' id='poster' required>
                    <label for='poster_alt'>Texte Alternatif</label>
                    <input type='text' name='poster_alt' id='poster_alt' required>
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
                    <label for='category'>Catégorie</label>
                    <select name='category' id='category' required>
                        <option value=''>-- Choisir une catégorie --</option>";
        foreach ($categories as $category) { $html .= "<option value='" . $category->getId() . "'>" . $category->getName() . "</option>"; }
        $html .= "</select>
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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('poster').addEventListener('change', function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('poster-preview').innerHTML = '<img src=\"' + e.target.result + '\" alt=\"' + file.name + '\">';
                        };
                        reader.readAsDataURL(file);
                    });
                    document.getElementById('poster_alt').addEventListener('change', function() { document.getElementById('poster-preview').getElementsByTagName('img')[0].alt = this.value; });
                });
                // TODO 1: Add form validation
            </script>
            ";

        return $html;
    }

    /**
     * @throws Exception
     */
    public function createMovie(array $data): void
    {
        // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
        $data['title'] = trim($data['title']);
        if (empty($data['title']) || strlen($data['title']) < 3 || strlen($data['title']) > 50)
        {
            throw new Exception('Le titre doit contenir entre 3 et 50 caractères');
        }

        // La date de sortie ne doit pas être vide, et doit être au format YYYY-MM-DD
        $data['release_date'] = trim($data['release_date']);
        if (empty($data['release_date']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['release_date']))
        {
            throw new Exception('La date de sortie doit être au format YYYY-MM-DD');
        }

        // La durée (en minutes) ne doit pas être vide, et doit être un entier positif
        $data['duration'] = trim($data['duration']);
        if (empty($data['duration']) || !ctype_digit($data['duration']) || $data['duration'] <= 0)
        {
            throw new Exception('La durée doit être un entier positif');
        }

        // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        /*$data['poster'] = $_FILES['poster'];
        if (empty($data['poster']['name']) || !in_array($data['poster']['type'], ['image/jpg', 'image/jpeg', 'image/png']))
        {
            throw new Exception('L\'affiche doit être une image (jpg, jpeg, png)');
        }*/

        // Le texte alternatif de l'affiche ne doit pas être vide, et doit contenir entre 3 et 50 caractères
        $data['poster_alt'] = trim($data['poster_alt']);
        if (empty($data['poster_alt']) || strlen($data['poster_alt']) < 3 || strlen($data['poster_alt']) > 50)
        {
            throw new Exception('Le texte alternatif de l\'affiche doit contenir entre 3 et 50 caractères');
        }

        // Le synopsis ne doit pas être vide, et doit contenir entre 10 et 500 caractères
        $data['synopsis'] = trim($data['synopsis']);
        if (empty($data['synopsis']) || strlen($data['synopsis']) < 10 || strlen($data['synopsis']) > 500)
        {
            throw new Exception('Le synopsis doit contenir entre 10 et 500 caractères');
        }

        // La bande annonce ne doit pas être vide, et doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)
        $data['trailer'] = trim($data['trailer']);
        if (empty($data['trailer']) || !filter_var($data['trailer'], FILTER_VALIDATE_URL) || !preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|dailymotion\.com|vimeo\.com)\/.+$/', $data['trailer']))
        {
            throw new Exception('La bande annonce doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)');
        }

        // La liste des catégories doit contenir au moins une catégorie. Si une catégorie n'existe pas, elle doit être ajoutée à la base de données
        $data['category'] = trim($data['category']);
        if (empty($data['category']))
        {
            throw new Exception('La catégorie doit contenir au moins une catégorie');
        }

        // La limite d'âge ne doit pas être vide, et doit être un entier positif entre 0 et 18
        $data['age_limit'] = trim($data['age_limit']);
        if (empty($data['age_limit']) || !ctype_digit($data['age_limit']) || $data['age_limit'] < 0 || $data['age_limit'] > 18)
        {
            throw new Exception('La limite d\'âge doit être un entier positif entre 0 et 18');
        }

        // Vu doit être un booléen. Si la date de sortie est supérieure à la date actuelle, vu doit être faux
        $data['seen'] = isset($data['seen']);
        if ($data['seen'] && $data['release_date'] > date('Y-m-d'))
        {
            $data['seen'] = false;
        }

        // Save movie to database
        //$data['poster'] = $this->savePoster($data['poster']);
        $movie_id = $this->saveMovie($data);
        if ($movie_id === 0)  { throw new Exception('Erreur lors de l\'ajout du film dans la base de données'); }
        else { $this->saveCategories(explode(',', $data['category']), $movie_id); }
    }

    private function savePoster(array $poster): string
    {
        $path = 'uploads/' . $poster['name'];
        move_uploaded_file($poster['tmp_name'], $path);
        return $path;
    }

    private function saveMovie(array $data): int
    {
        $movieDB = new MoviesDB();
        return $movieDB->addMovieAndReturnId($data['title'], $data['release_date'], $data['synopsis'], $data['seen'], $data['poster'], $data['duration'], -1, $data['trailer'], $data['age_limit']);
    }

    private function saveCategories(array $categories, int $movie_id): void
    {
        $linkDB = new LinkBD();
        foreach ($categories as $category)
        {
            $linkDB->addMovie_Tag($movie_id, $category);
        }
    }
}