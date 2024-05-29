<?php

namespace mdb;

class MovieForm
{
    public function getForm(): string
    {
        return "<h2>Ajouter un Nouveau Film Manuellement</h2>
                <form action='admin.php' method='POST'>
                    <label for='title'>Titre :</label>
                    <input type='text' id='title' name='title' required>
                    <label for='release_date'>Date de sortie :</label>
                    <input type='date' id='release_date' name='release_date' required>
                    <label for='synopsis'>Synopsis :</label>
                    <textarea id='synopsis' name='synopsis' required></textarea>
                    <label for='image_path'>Chemin de l'affiche :</label>
                    <input type='text' id='image_path' name='image_path' required>
                    <label for='vu'>Vu :</label>
                    <input type='checkbox' id='vu' name='vu'>
                    <input type='submit' value='Ajouter'>
                </form>";
    }
}