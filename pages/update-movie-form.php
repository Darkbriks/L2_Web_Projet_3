<?php
use mdb\MoviesDB;

$movieDB = new MoviesDB();
$movies = $movieDB->getMovies(); // Récupère tous les films existants depuis la base de données
?>
<form method='POST' enctype='multipart/form-data' class="add-movie-form" id="update-movie-form">
    <div id="add-movie-form-msg">
        <?php if (isset($add_movie_error)) { echo "<div class='alert alert-warning' role='alert'>$add_movie_error</div>"; } ?>
        <?php if (isset($add_movie_success)) { echo "<div class='alert alert-success' role='alert'>$add_movie_success</div>"; } ?>
    </div>
    <label for="movie_id"><?php echo $GLOBALS['update-movie-form-title']; ?></label>
    <select name="movie_id" id="movie_id">
        <?php foreach ($movies as $movie) { ?>
            <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        <?php } ?>
    </select>
    <!-- Ajoutez les autres champs du formulaire pour permettre à l'utilisateur de modifier les informations du film -->
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='title' id='title' placeholder='<?php echo $GLOBALS['movie-form-add-movie-title-placeholder']; ?>'>
        <label for='title'><?php echo $GLOBALS['movie-form-add-movie-title-placeholder']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='date' name='release_date' id='release_date' placeholder='<?php echo $GLOBALS['movie-form-add-movie-release-date']; ?>'>
        <label for='release_date'><?php echo $GLOBALS['movie-form-add-movie-release-date']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" name='synopsis' id='synopsis' placeholder='<?php echo $GLOBALS['movie-form-add-movie-synopsis-placeholder']; ?>'></textarea>
        <label for='synopsis'><?php echo $GLOBALS['movie-form-add-movie-synopsis']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='file' name='image_path' id='image_path' placeholder='<?php echo $GLOBALS['movie-form-add-movie-image']; ?>'>
        <label for='image_path'><?php echo $GLOBALS['movie-form-add-movie-image']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='duration' id='duration' placeholder='<?php echo $GLOBALS['movie-form-add-movie-duration-placeholder']; ?>'>
        <label for='duration'><?php echo $GLOBALS['movie-form-add-movie-duration']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='note' id='note' placeholder='<?php echo $GLOBALS['movie-form-add-movie-score']; ?>'>
        <label for='note'><?php echo $GLOBALS['movie-form-add-movie-score']; ?></label>
    </div>
    <div class="mb-3">
        <label for='age_limit' hidden><?php echo $GLOBALS['movie-form-add-movie-age-rating'] ?></label>
        <select class="form-select" name='age_limit' id='age_limit'>
            <option value='1'><?php echo $GLOBALS['movie-form-add-movie-age-rating'] ?></option>
            <option value='1'><?php echo $GLOBALS['movie-form-add-movie-age-rating-all'] ?></option>
            <option value='10'>10 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='12'>12 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='16'>16 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='18'>18 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
        </select>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='trailer' id='trailer' placeholder='<?php echo $GLOBALS['movie-form-add-movie-trailer-placeholder'] ?>'>
        <label for='trailer'><?php echo $GLOBALS['movie-form-add-movie-trailer'] ?></label>
    </div>
    <input type="submit" class = "btn btn-warning" id='update-movie-btn' value="<?php echo $GLOBALS['update-movie-form-question']; ?>">
    <input type="submit" class="btn btn-outline-danger" name="delete_movie" value="<?php echo $GLOBALS['delete-movie-form']; ?>">
</form>
<div id="update-movie-form-msg"></div>
<div class="space"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('update-movie-btn').addEventListener('click', function() {
            console.log('Update movie button clicked');
            let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
            add_person_modal.show();
        });
        document.querySelector('#update-movie-form').addEventListener('submit', function(e) {
            document.getElementById('update-movie-form-msg').innerHTML = '';
            e.preventDefault();
            console.log('Form submit prevented for validation');
            if (checkMovieForm('.update-movie-form','update-movie-form-msg')) {
                document.querySelector('.update-movie-form').submit();
            } else {
            }
        });
    });

</script>

<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movie_id'])) {

    if (isset($_POST['delete_movie'])) {
        $movie_id = $_POST['movie_id'];
        // Appeler la fonction pour supprimer le film avec l'ID spécifié
        $success = $movieDB->deleteMovieAndRelationsById($movie_id);

        if (!empty($success)) {
            echo "Le film a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du film.";
        }

        // Rediriger l'utilisateur vers la même page pour éviter la soumission multiple du formulaire
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>
