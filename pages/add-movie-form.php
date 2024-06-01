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
        <label for='category'><?php echo $GLOBALS['movie-form-add-movie-tags'] ?></label>
        <div id='category'>
            <?php foreach ($categories as $category) {?>
                <div class="form-check">
                    <input class="form-check-input" type='checkbox' name='category[]' id='category_<?php echo $category->getId() ?>' value='<?php echo $category->getId() ?>'>
                    <label class="form-check-label" for='category_<?php echo $category->getId() ?>'><?php echo $category->getName() ?></label>
                </div>
            <?php } ?>
        </div>
        <div class="form-floating input-group">
            <input class="form-control" type='text' id='newCategory' placeholder='<?php echo $GLOBALS['movie-form-add-movie-new-tag'] ?>'>
            <label for='newCategory'><?php echo $GLOBALS['movie-form-add-movie-new-tag'] ?></label>
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

    <div class="form-floating mb-3">
        <label for='directorDataList' class='form-label' hidden><?php echo $GLOBALS['movie-form-add-movie-director-to-add'] ?></label>
        <div class='directorList'></div>
        <div class='input-group mb-3'>
            <input class='form-control' list='datalistOptions' id='directorDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-director-placeholder'] ?>'>
            <button type='button' class='input-group-text' id='AddDirectorButton'><?php echo $GLOBALS['movie-form-add-movie-add-director'] ?></button>
        </div>
        <datalist id='datalistOptions'>
            <?php foreach ($persons as $person) { ?><option value='<?php echo $person->getFirstName()?> <?php echo $person->getLastName() ?>'><?php } ?>
        </datalist>
    </div>

    <div>
        <label for='actorDataList' class='form-label' hidden><?php echo $GLOBALS['movie-form-add-movie-actor-to-add'] ?></label>
        <div class='actorList'></div>
        <div class='input-group mb-3'>
            <input class='form-control' list='datalistOptions' id='actorDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-actor-placeholder'] ?>'>
            <span class='input-group-text'><?php echo $GLOBALS['movie-form-add-movie-add-actor-role'] ?></span>
            <input class='form-control' id='role' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-actor-role-placeholder'] ?>'>
            <button type='button' class='input-group-text' id='AddActorButton'><?php echo $GLOBALS['movie-form-add-movie-add-actor'] ?></button>
        </div>
        <datalist id='datalistOptions'>
            <?php foreach ($persons as $person) { ?><option value='<?php echo $person->getFirstName() ?> <?php echo $person->getLastName() ?>'><?php } ?>
        </datalist>
    </div>

    <div>
        <label for='composerDataList' class='form-label' hidden><?php echo $GLOBALS['movie-form-add-movie-composer-to-add'] ?></label>
        <div class='composerList'></div>
        <div class='input-group mb-3'>
            <input class='form-control' list='datalistOptions' id='composerDataList' placeholder='<?php echo $GLOBALS['movie-form-add-movie-add-composer-placeholder'] ?>'>
            <button type='button' class='input-group-text' id='AddComposerButton'><?php echo $GLOBALS['movie-form-add-movie-add-composer'] ?></button>
        </div>
        <datalist id='datalistOptions'>
            <?php foreach ($persons as $person) { ?><option value='<?php echo $person->getFirstName() ?> <?php echo $person->getLastName() ?>'><?php } ?>
        </datalist>
    </div>

    <div>
        <label for='seen'><?php echo $GLOBALS['movie-form-add-movie-seen'] ?></label>
        <input type='checkbox' name='seen' id='seen' value='0'>
    </div>

    <div>
        <button type='submit'><?php echo $GLOBALS['movie-form-add-movie-add'] ?></button>
        <button type='reset'><?php echo $GLOBALS['movie-form-add-movie-cancel'] ?></button>
    </div>

</form>

<script src=<?php echo $GLOBALS['JS_DIR'] . "add-movie-form.js" ?>></script>