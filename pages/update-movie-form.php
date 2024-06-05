<?php
use mdb\MoviesDB;

$movieDB = new MoviesDB();
$movies = $movieDB->getMovies(); // Récupère tous les films existants depuis la base de données
?>
<form method='POST' enctype='multipart/form-data' class="update-movie-form" id="update-movie-form">
    <label for="movie_id"><?php echo $GLOBALS['update-movie-form-title']; ?></label>
    <select name="movie_id" id="movie_id">
        <?php foreach ($movies as $movie) { ?>
            <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        <?php } ?>
    </select>
    <!-- Ajoutez les autres champs du formulaire pour permettre à l'utilisateur de modifier les informations du film -->
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='new_title' id='new_title' placeholder='<?php echo $GLOBALS['movie-form-add-movie-title-placeholder']; ?>'>
        <label for='new_title'><?php echo $GLOBALS['movie-form-add-movie-title-placeholder']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='date' name='new_release_date' id='new_release_date' placeholder='<?php echo $GLOBALS['movie-form-add-movie-release-date']; ?>'>
        <label for='new_release_date'><?php echo $GLOBALS['movie-form-add-movie-release-date']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" name='new_synopsis' id='new_synopsis' placeholder='<?php echo $GLOBALS['movie-form-add-movie-synopsis-placeholder']; ?>'></textarea>
        <label for='new_synopsis'><?php echo $GLOBALS['movie-form-add-movie-synopsis']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='file' name='new_image_path' id='new_image_path' placeholder='<?php echo $GLOBALS['movie-form-add-movie-image']; ?>'>
        <label for='new_image_path'><?php echo $GLOBALS['movie-form-add-movie-image']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='new_time_duration' id='new_time_duration' placeholder='<?php echo $GLOBALS['movie-form-add-movie-duration-placeholder']; ?>'>
        <label for='new_time_duration'><?php echo $GLOBALS['movie-form-add-movie-duration']; ?></label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='new_note' id='new_note' placeholder='<?php echo $GLOBALS['movie-form-add-movie-score']; ?>'>
        <label for='new_note'><?php echo $GLOBALS['movie-form-add-movie-score']; ?></label>
    </div>
    <div class="mb-3">
        <label for='new_rating' hidden><?php echo $GLOBALS['movie-form-add-movie-age-rating']; ?></label>
        <select class="form-select" name='new_rating' id='new_rating'>
            <option value=''><?php echo $GLOBALS['movie-form-add-movie-age-rating']; ?></option>
            <option value='1'><?php echo $GLOBALS['movie-form-add-movie-age-rating-all']; ?></option>
            <option value='10'>10 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number']; ?></option>
            <option value='12'>12 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number']; ?></option>
            <option value='16'>16 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number']; ?></option>
            <option value='18'>18 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number']; ?></option>
        </select>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='new_trailer_path' id='new_trailer_path' placeholder='<?php echo $GLOBALS['movie-form-add-movie-trailer-placeholder']; ?>'>
        <label for='new_trailer_path'><?php echo $GLOBALS['movie-form-add-movie-trailer']; ?></label>
    </div>
    <input type="submit" value="<?php echo $GLOBALS['update-movie-form-question']; ?>">
    <input type="submit" name="delete_movie" value="<?php echo $GLOBALS['delete-movie-form']; ?>">
</form>
<div id="update-movie-form-msg"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('update-movie-btn').addEventListener('click', function() {
            console.log('Update movie button clicked');
            let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
            add_person_modal.show();
        });
    });

    document.querySelector('#update-movie-form').addEventListener('submit', function(e) {
        document.getElementById('update-movie-form-msg').innerHTML = '';
        e.preventDefault();
        console.log('Form submit prevented for validation');
        if (validateMovieForm()) {
            console.log('Form validation passed');
            document.querySelector('.update-movie-form').submit();
        } else {
            console.log('Form validation failed');
        }
    });

    function validateMovieForm() {
        let form = document.querySelector('.update-movie-form');
        let title = form.querySelector('#new_title').value.trim();
        let releaseDate = form.querySelector('#new_release_date').value.trim();
        let synopsis = form.querySelector('#new_synopsis').value.trim();
        let image = form.querySelector('#new_image_path').value.trim();
        let timeDuration = parseInt(form.querySelector('#new_time_duration').value);
        let note = parseFloat(form.querySelector('#new_note').value);
        let rating = form.querySelector('#new_rating').value.trim();
        let trailerPath = form.querySelector('#new_trailer_path').value.trim();

        if (title.length < 3 || title.length > 50) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-title']; ?>", "warning");
            return false;
        }

        if (!releaseDate) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-release-date']; ?>", "warning");
            return false;
        }
        if (new Date(releaseDate) > new Date()) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-release-date']; ?>", "warning");
            return false;
        }

        if (synopsis.length > 500) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-synopsis']; ?>", "warning");
            return false;
        }

        if (image.length === 0) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-image']; ?>", "warning");
            return false;
        }

        if (timeDuration < 0 || timeDuration > 300) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-duration']; ?>", "warning");
            return false;
        }

        if (note < 0 || note > 5) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-note']; ?>", "warning");
            return false;
        }

        if (rating.length === 0) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-rating']; ?>", "warning");
            return false;
        }

        if (trailerPath.length > 255) {
            showMovieFormMsg("<?php echo $GLOBALS['movie-form-exception-trailer']; ?>", "warning");
            return false;
        }

        return true;
    }

    function showMovieFormMsg(msg, type) {
        let form_msg = document.getElementById('update-movie-form-msg');
        form_msg.innerHTML = '<div class="alert alert-' + type + '" role="alert">' + msg + '</div>';
        console.log(msg);
    }
</script>

<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movie_id'])) {

    $movie_id = $_POST['movie_id'];
    if (isset($_POST['delete_movie'])) {
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

    // Vérifier si les champs requis sont présents
    if (isset($_POST['new_title']) && isset($_POST['new_release_date']) && isset($_POST['new_synopsis']) && isset($_FILES['new_image_path']) && isset($_POST['new_time_duration']) && isset($_POST['new_note']) && isset($_POST['new_rating']) && isset($_POST['new_trailer_path'])) {
        // Récupérer les valeurs des champs
        $new_title = htmlspecialchars(trim($_POST['new_title']));
        $new_release_date = htmlspecialchars(trim($_POST['new_release_date']));
        $new_synopsis = htmlspecialchars(trim($_POST['new_synopsis']));
        $new_time_duration = htmlspecialchars(trim($_POST['new_time_duration']));
        $new_note = htmlspecialchars(trim($_POST['new_note']));
        $new_rating = htmlspecialchars(trim($_POST['new_rating']));
        $new_trailer_path = $_POST['new_trailer_path'];
        $new_image_name = $_FILES['new_image_path']['name'];
        $new_image_tmp_path = $_FILES['new_image_path']['tmp_name'];


        // Traiter l'image si elle a été téléchargée
        $target_dir = "uploads/";
        $new_image_path = $target_dir . basename($new_image_name);

        // Traiter l'image si elle a été téléchargée
        if ($_FILES['new_image_path']['size'] > 0) {
            // Déplacer l'image téléchargée vers le dossier d'uploads
            move_uploaded_file($new_image_tmp_path, $new_image_path);
        }

        if (validateForm($movie_id, $new_title, $new_release_date, $new_synopsis, $new_image_path, $new_time_duration, $new_note, $new_rating, $new_trailer_path)) {

            $success = $movieDB->alterMovie($movie_id, $new_title, $new_release_date, $new_synopsis, $new_image_path, $new_time_duration, $new_note, $new_rating, $new_trailer_path);
            if ($success) {
                echo "Les informations du film ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations du film.";
            }

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    else {
        // Afficher un message d'erreur si des champs requis sont manquants
        echo "Tous les champs requis doivent être remplis.";
    }
}

function validateForm($movie_id, $new_title, $new_release_date, $new_synopsis, $new_image_path, $new_time_duration, $new_note, $new_rating, $new_trailer_path)
{
    // Vérification si tous les champs requis sont remplis
    if (empty($movie_id) || empty($new_title) || empty($new_release_date) || empty($new_synopsis) || empty($new_image_path) || empty($new_time_duration) || empty($new_note) || empty($new_rating) || empty($new_trailer_path)) {
        echo "Tous les champs requis doivent être remplis.";
        return false;
    }

    // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    $new_title = trim($new_title);
    if (strlen($new_title) < 3 || strlen($new_title) > 50) {
        echo "Le titre doit contenir entre 3 et 50 caractères.";
        return false;
    }

    // La date de sortie ne doit pas être vide, et doit être au format YYYY-MM-DD
    $new_release_date = trim($new_release_date);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $new_release_date)) {
        echo "La date de sortie doit être au format YYYY-MM-DD.";
        return false;
    }

    // La durée (en minutes) ne doit pas être vide, et doit être un entier positif
    $new_time_duration = trim($new_time_duration);
    if (!is_numeric($new_time_duration) || $new_time_duration < 0) {
        echo "La durée doit être un nombre positif.";
        return false;
    }

    // Le synopsis ne doit pas être vide, et doit contenir entre 10 et 500 caractères
    $new_synopsis = trim($new_synopsis);
    if (strlen($new_synopsis) < 10 || strlen($new_synopsis) > 500) {
        echo "Le synopsis doit contenir entre 10 et 500 caractères.";
        return false;
    }

    // L'image ne doit pas être vide
    if (empty($new_image_path)) {
        echo "L'image est requise.";
        return false;
    }

    // La bande annonce doit être une URL valide
    $new_trailer_path = trim($new_trailer_path);
    if (!filter_var($new_trailer_path, FILTER_VALIDATE_URL)) {
        echo "La bande annonce doit être une URL valide.";
        return false;
    }

    // La limite d'âge doit être un entier positif entre 0 et 18
    $new_rating = trim($new_rating);
    if (!is_numeric($new_rating) || $new_rating < 0 || $new_rating > 18) {
        echo "La limite d'âge doit être un entier positif entre 0 et 18.";
        return false;
    }

    // Tout les acteurs doivent avoir un rôle


    return true;
}

?>
