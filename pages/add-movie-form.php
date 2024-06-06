<?php

use mdb\PersonDB;
use mdb\TagDB;

try
{
    $tagDB = new TagDB();
    $categories = $tagDB->getTags();

    $personDB = new PersonDB();
    $persons = $personDB->getPersons();
}
catch (Exception $e) { $add_movie_error = $e->getMessage(); }
?>

<script src="../js/form-utilities.js"></script>
<!-- TODO: Use GenerateFormInput (create new method if necessary) -->

<form method='POST' enctype='multipart/form-data' class="add-movie-form">
    <div id="add-movie-form-msg">
        <?php if (isset($add_movie_error)) { echo "<div class='alert alert-warning' role='alert'>$add_movie_error</div>"; } ?>
        <?php if (isset($add_movie_success)) { echo "<div class='alert alert-success' role='alert'>$add_movie_success</div>"; } ?>
    </div>

    <h2><?php echo $GLOBALS['movie-form-title'] ?></h2>

    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='title' id='title' required placeholder='<?php echo $GLOBALS['movie-form-add-movie-title-placeholder'] ?>'>
        <label for='title'><?php echo $GLOBALS['movie-form-add-movie-title'] ?></label>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" type='date' name='release_date' id='release_date' required>
        <label for='release_date'><?php echo $GLOBALS['movie-form-add-movie-release-date'] ?></label>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='duration' id='duration' required placeholder='<?php echo $GLOBALS['movie-form-add-movie-duration-placeholder'] ?>'>
        <label for='duration'><?php echo $GLOBALS['movie-form-add-movie-duration'] ?></label>
    </div>

    <div class="mb-3">
        <label for='image-path' class="form-label"><?php echo $GLOBALS['movie-form-add-movie-poster'] ?></label>
        <div style="display: flex">
            <input class="form-control" type='file' name='image-path' id='image-path' required accept='image/jpeg, image/jpg, image/png'>
            <button type="button" class="btn-close" aria-label="Close" id="remove-poster-btn"></button>
        </div>
        <div id='posters-preview'><img src='' alt=''></div>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" name='synopsis' id='synopsis' required placeholder='<?php echo $GLOBALS['movie-form-add-movie-synopsis-placeholder'] ?>'></textarea>
        <label for='synopsis'><?php echo $GLOBALS['movie-form-add-movie-synopsis'] ?></label>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='trailer' id='trailer' required placeholder='<?php echo $GLOBALS['movie-form-add-movie-trailer-placeholder'] ?>'>
        <label for='trailer'><?php echo $GLOBALS['movie-form-add-movie-trailer'] ?></label>
    </div>

    <div class="mb-3">
        <label><?php echo $GLOBALS['movie-form-add-movie-tags'] ?></label>
        <div id='category'>
            <?php foreach ($categories as $category) {?>
                <div class="form-check">
                    <input class="form-check-input" type='checkbox' name='category[]' id='category_<?php echo $category->getId() ?>' value='<?php echo $category->getId() ?>'>
                    <label class="form-check-label" for='category_<?php echo $category->getId() ?>'><?php echo $category->getName() ?></label>
                </div>
            <?php } ?>
        </div>
        <div class="input-group">
            <input class="form-control" type='text' id='newCategory' placeholder='<?php echo $GLOBALS['movie-form-add-movie-new-tag'] ?>'>
            <label for='newCategory' hidden><?php echo $GLOBALS['movie-form-add-movie-new-tag'] ?></label>
            <button class='input-group-text' type='button' id='addCategory'><?php echo $GLOBALS['movie-form-add-movie-add-tag'] ?></button>
        </div>
    </div>

    <div class="mb-3">
        <label for='age_limit' hidden><?php echo $GLOBALS['movie-form-add-movie-age-rating'] ?></label>
        <select class="form-select" name='age_limit' id='age_limit' required>
            <option value=''><?php echo $GLOBALS['movie-form-add-movie-age-rating'] ?></option>
            <option value='1'><?php echo $GLOBALS['movie-form-add-movie-age-rating-all'] ?></option>
            <option value='10'>10 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='12'>12 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='16'>16 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='18'>18 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
        </select>
    </div>

    <div class="mb-3">
        <p><?php echo $GLOBALS['movie-form-add-movie-directors-list'] ?></p>
        <div id='directorList'></div>
        <div class='form-floating  mb-3'>
            <input class='form-control' list='datalistOptions' id='directorDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-director'] ?>'>
            <label for='directorDataList' class='form-label'><?php echo $GLOBALS['movie-form-add-movie-add-director'] ?></label>
        </div>
        <div class="list-group" id='directorDatalistOptions'></div>
    </div>

    <div class="mb-3">
        <p><?php echo $GLOBALS['movie-form-add-movie-actors-list'] ?></p>
        <div id='actorList'></div>
        <div class='form-floating  mb-3'>
            <input class='form-control' list='datalistOptions' id='actorDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-actor'] ?>'>
            <label for='actorDataList' class='form-label'><?php echo $GLOBALS['movie-form-add-movie-add-actor'] ?></label>
        </div>
        <div class="list-group" id='actorDatalistOptions'></div>
    </div>

    <div class="mb-3">
        <p><?php echo $GLOBALS['movie-form-add-movie-composers-list'] ?></p>
        <div id='composerList'></div>
        <div class='form-floating  mb-3'>
            <input class='form-control' list='datalistOptions' id='composerDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-composer'] ?>'>
            <label for='composerDataList' class='form-label'><?php echo $GLOBALS['movie-form-add-movie-add-composer'] ?></label>
        </div>
        <div class="list-group" id='composerDatalistOptions'></div>
    </div>

    <div class="mb-3 form-check">
        <input class="form-check-input" type='checkbox' name='seen' id='seen' value='0'>
        <label class="form-check-label" for='seen'><?php echo $GLOBALS['movie-form-add-movie-seen'] ?></label>
    </div>

    <div class="mb-3 login-form-submit">
        <button class="btn btn-success"><?php echo $GLOBALS['movie-form-add-movie-add'] ?></button>
        <span style="width: 25px"></span>
        <button class="btn btn-danger" type='reset'><?php echo $GLOBALS['movie-form-add-movie-cancel'] ?></button>
    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function()
    {
        document.getElementById('image-path').addEventListener('change', function() { updatePosterPreview(this); });
        document.getElementById('remove-poster-btn').addEventListener('click', removePoster);

        document.getElementById('addCategory').addEventListener('click', addTag);

        document.getElementById('directorDataList').addEventListener('input', function()
        {
            let director = document.getElementById('directorDataList').value;
            if (director.length > 0) { updateOptionList('director', director); }
            else { clearOptionList('director'); }
        });

        document.getElementById('actorDataList').addEventListener('input', function()
        {
            let actor = document.getElementById('actorDataList').value;
            if (actor.length > 0) { updateOptionList('actor', actor, true); }
            else { clearOptionList('actor'); }
        });

        document.getElementById('composerDataList').addEventListener('input', function()
        {
            let composer = document.getElementById('composerDataList').value;
            if (composer.length > 0) { updateOptionList('composer', composer); }
            else { clearOptionList('composer'); }
        });

        document.querySelector('.add-movie-form').addEventListener('submit', function(e)
        {
            document.getElementById('add-movie-form-msg').innerHTML = '';
            e.preventDefault();
            if (validateForm()) { this.submit(); }
            else { window.scrollTo(0, 0); }
        });
    });

    function updatePosterPreview(input)
    {
        let postersPreview = document.getElementById('posters-preview');
        if (postersPreview === null) { postersPreview = document.getElementById('posters-preview-apply'); }
        else { postersPreview.id = 'posters-preview-apply'; }

        let posters = input.files;
        if (posters.length > 0)
        {
            let reader = new FileReader();
            reader.onload = function(e) { postersPreview.innerHTML = '<img src="' + e.target.result + '" alt="Poster">'; }
            reader.readAsDataURL(image-path[0]);
        }
        else { removePoster() }
    }

    function removePoster()
    {
        let postersPreview = document.getElementById('posters-preview-apply');
        if (postersPreview === null) { postersPreview = document.getElementById('posters-preview'); }
        else { postersPreview.id = 'posters-preview'; }
        postersPreview.innerHTML = '';
        document.getElementById('image-path').value = '';
    }

    function addTag()
    {
        let newCategory = document.getElementById('newCategory').value.trim();
        if (newCategory)
        {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../api/add-tag.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('tag=' + newCategory);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200)
                {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success)
                    {
                        let newCategory = document.createElement('div');
                        newCategory.className = 'form-check';
                        newCategory.innerHTML = '<input class=\"form-check-input\" type=\"checkbox\" name=\"category[]\" id=\"category_' + response.id + '\" value=\"' + response.id + '\"><label class=\"form-check-label\" for=\"category_' + response.id + '\">' + response.name + '</label>';
                        document.getElementById("category").appendChild(newCategory);
                    }
                    else { showMovieFormMsg(response.error, 'danger'); }
                }
            };
        }
    }

    function validateForm() {
        let form = document.querySelector('.add-movie-form');
        let title = form.querySelector('#title').value;
        let release_date = form.querySelector('#release_date').value;
        let duration = form.querySelector('#duration').value;
        let posters = form.querySelector('#image-path').value;
        let synopsis = form.querySelector('#synopsis').value;
        let trailer = form.querySelector('#trailer').value;
        let age_limit = form.querySelector('#age_limit').value;
        let actors = form.querySelectorAll('#actorList .input');

        // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
        title = title.trim(); if (title.length < 3 || title.length > 50) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-title'] ?>", 'danger'); return false; }

        // La date de sortie ne doit pas être vide, et doit être au format YYYY-MM-DD
        release_date = release_date.trim(); if (!release_date.match(/^\d{4}-\d{2}-\d{2}$/)) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-release-date'] ?>", 'danger'); return false; }

        // La durée (en minutes) ne doit pas être vide, et doit être un entier positif
        duration = duration.trim(); if (isNaN(duration) || duration < 0) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-duration'] ?>", 'danger'); return false; }

        // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
        posters = posters.trim(); if (posters.length === 0) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-poster'] ?>", 'danger'); return false; }

        // Le synopsis ne doit pas être vide, et doit contenir entre 10 et 500 caractères
        synopsis = synopsis.trim(); if (synopsis.length < 10 || synopsis.length > 500) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-synopsis'] ?>", 'danger'); return false; }

        // La bande annonce ne doit pas être vide, et doit être une URL valide vers une vidéo (youtube, dailymotion, vimeo)
        trailer = trailer.trim(); if (!trailer.match(/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|dailymotion\.com|vimeo\.com)\/.+$/)) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-trailer'] ?>", 'danger'); return false; }

        // La liste des catégories doit contenir au moins un élément
        let categories = form.querySelectorAll('#category input:checked');
        if (categories.length === 0) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-tags'] ?>", 'danger'); return false; }

        // La limite d'âge ne doit pas être vide, et doit être un entier positif entre 0 et 18
        age_limit = age_limit.trim(); if (isNaN(age_limit) || age_limit < 0 || age_limit > 18) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-age-rating'] ?>", 'danger'); return false; }

        // Vu doit être un booléen. Si la date de sortie est supérieure à la date actuelle, vu doit être faux
        let release_date_obj = new Date(release_date);
        let seen = form.querySelector('#seen').checked;
        if (seen && release_date_obj > new Date()) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-seen'] ?>", 'danger'); return false; }

        // Tout les acteurs doivent avoir un rôle
        for (let actor of actors)
        {
            let role = actor.querySelector('input[type="text"]');
            if (role === null || role.value.trim().length === 0) { showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-actor-role'] ?>", 'danger'); return false; }
        }

        return true;
    }

    function showMovieFormMsg(msg, type)
    {
        set_user_msg(msg, type, document.getElementById('add-movie-form-msg'))
        scroll(0, 0);
    }
</script>