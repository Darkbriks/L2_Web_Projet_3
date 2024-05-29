<?php

namespace mdb;

class MovieForm
{
    public function getForm(): string
    {
        return "<h2>Ajouter un Nouveau Film Manuellement</h2>
            <form action='admin.php' method='POST'>
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
                        <option value='action'>Action</option>
                        <option value='comedy'>Comédie</option>
                        <option value='drama'>Drame</option>
                        <option value='horror'>Horreur</option>
                        <option value='animation'>Animation</option>
                        <--! TODO: Load categories from database -->
                    </select>
                </div>
                <div> 
                    <label for='age_limit'>Limite d'Age</label>
                    <select name='age_limit' id='age_limit' required>
                        <option value='0'>Tout Public</option>
                        <option value='10'>10 ans et +</option>
                        <option value='12'>12 ans et +</option>
                        <option value='16'>16 ans et +</option>
                        <option value='18'>18 ans et +</option>
                    </select>
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
                // TODO: Add form validation
            </script>
            ";
    }

    public function createMovie(array $data): void
    {
        // TODO: Implement this method
    }
}