<?php

use mdb\PersonDB;
use mdb\TagDB;

$tagDB = new TagDB();
$categories = $tagDB->getTags();

$personDB = new PersonDB();
$persons = $personDB->getPersons();
?>

<form method='POST' enctype='multipart/form-data' class="add-movie-form">
    <?php if (isset($add_movie_error)) { echo "<div class='alert alert-warning' role='alert'>$add_movie_error</div>"; } ?>
    <?php if (isset($add_movie_success)) { echo "<div class='alert alert-success' role='alert'>$add_movie_success</div>"; } ?>

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
        <label for='posters' class="form-label"><?php echo $GLOBALS['movie-form-add-movie-poster'] ?></label>
        <!--input class="form-control" type='file' name='posters' id='posters' required accept='image/jpeg, image/jpg, image/png'-->
        <div style="display: flex">
            <input class="form-control" type='file' name='posters' id='posters' required accept='image/jpeg, image/jpg, image/png'>
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
        <button class="btn btn-success" type='submit'><?php echo $GLOBALS['movie-form-add-movie-add'] ?></button>
        <span style="width: 25px"></span>
        <button class="btn btn-danger" type='reset'><?php echo $GLOBALS['movie-form-add-movie-cancel'] ?></button>
    </div>

</form>

<script src=<?php echo $GLOBALS['JS_DIR'] . "add-movie-form.js" ?>></script>

<script>
    document.addEventListener('DOMContentLoaded', function()
    {
        document.getElementById('directorDataList').addEventListener('input', function()
        {
            let director = document.getElementById('directorDataList').value;
            if (director.length > 0) { updateOptionList('director', director); }
            else { clearOptionList('director'); }
        });

        document.getElementById('actorDataList').addEventListener('input', function()
        {
            let actor = document.getElementById('actorDataList').value;
            if (actor.length > 0) { updateOptionList('actor', actor); }
            else { clearOptionList('actor'); }
        });

        document.getElementById('composerDataList').addEventListener('input', function()
        {
            let composer = document.getElementById('composerDataList').value;
            if (composer.length > 0) { updateOptionList('composer', composer); }
            else { clearOptionList('composer'); }
        });
    });

    function updateOptionList(type, value)
    {
        // TODO: Ajouter la possibilité de créer une personne si elle n'existe pas
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/get-data.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('table=person&conditionLength=2&attribute0=first_name&attribute1=last_name&value0=' + value + '&value1=' + value + '&and=false&limit=5&useLike=true');
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4 && xhr.status === 200)
            {
                let response = JSON.parse(xhr.responseText);
                if (response.success)
                {
                    let personList = document.getElementById(type + 'DatalistOptions');
                    personList.innerHTML = '';
                    let data = JSON.parse(response.data);
                    data.forEach(function(person)
                    {
                        let option = document.createElement('button');
                        option.classList.add('list-group-item', 'list-group-item-action');
                        option.innerHTML = person.first_name + ' ' + person.last_name;
                        option.id = person.id;
                        option.addEventListener('click', addPersonToList.bind(null, type, person.id, person.first_name + ' ' + person.last_name));
                        personList.appendChild(option);
                    });
                }
                else { console.log('Erreur:', response.error); }
            }
        }
    }

    function clearOptionList(type) { let personList = document.getElementById(type + 'DatalistOptions'); personList.innerHTML = ''; }

    // TODO: Améliorer le style du bouton de suppression
    function addPersonToList(type, id, name)
    {
        let personList = document.getElementById(type + 'List');
        personList.querySelectorAll('.input').forEach(function(person)
        {
            if (person.value === id) { console.log('Personne déjà ajoutée'); return; }
            // TODO: Fix this
        });

        let person = document.createElement('div');
        person.classList.add('input-group', 'mb-3');

        if (type !== 'actor') { person.innerHTML = '<input class="form-control" type="text" value="' + name + '" readonly><button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removePersonFromList(this)"></button><input type="hidden" name="' + type + '[]" value="' + id + '">'; }
        else
        {
            let role = document.createElement('input');
            role.classList.add('form-control');
            role.type = 'text';
            role.placeholder = 'Rôle';
            role.name = type + '_role[]';
            person.innerHTML = '<input class="form-control" type="text" value="' + name + '" readonly><input type="hidden" name="' + type + '[]" value="' + id + '">';
            person.appendChild(role);
            person.innerHTML += '<button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removePersonFromList(this)"></button>';
        }

        personList.appendChild(person);
        clearOptionList(type);
        document.getElementById(type + 'DataList').value = '';
    }

    function removePersonFromList(button) { button.parentElement.remove(); }
</script>