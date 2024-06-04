<?php
use mdb\MoviesDB;

$movieDB = new MoviesDB();
$movies = $movieDB->getMovies(); // Récupère tous les films existants depuis la base de données
?>

<form method='POST' enctype='multipart/form-data' class="update-movie-form">
    <label for="movie_id">Choisir un film à mettre à jour :</label>
    <select name="movie_id" id="movie_id">
        <?php foreach ($movies as $movie) { ?>
            <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        <?php } ?>
    </select>
    <!-- Ajoutez les autres champs du formulaire pour permettre à l'utilisateur de modifier les informations du film -->
    <!-- Par exemple, pour mettre à jour le titre du film -->
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='new_title' id='new_title' placeholder='Nouveau titre'>
        <label for='new_title'>Nouveau titre</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='date' name='new_release_date' id='new_release_date' placeholder='Nouveau release_date'>
        <label for='new_release_date'>Nouveau release_date</label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" name='new_synopsis' id='new_synopsis' placeholder='Nouveau synopsis'></textarea>
        <label for='new_synopsis'>Nouveau synopsis</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='file' name='new_image_path' id='new_image_path' placeholder='Nouveau image_path'>
        <label for='new_image_path'>Nouveau image_path</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='new_time_duration' id='new_time_duration' placeholder='Nouveau time_duration'>
        <label for='new_time_duration'>Nouveau time_duration</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='number' name='new_note' id='new_note' placeholder='Nouveau new_note'>
        <label for='new_note'>Nouveau note</label>
    </div>
    <div class="mb-3">
        <label for='new_rating' hidden>Nouveau rating ?></label>
        <select class="form-select" name='new_rating' id='new_rating'>
            <option value=''><?php echo $GLOBALS['movie-form-add-movie-age-rating'] ?></option>
            <option value='1'><?php echo $GLOBALS['movie-form-add-movie-age-rating-all'] ?></option>
            <option value='10'>10 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='12'>12 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='16'>16 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
            <option value='18'>18 <?php echo $GLOBALS['movie-form-add-movie-age-rating-number'] ?></option>
        </select>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type='text' name='new_trailer_path' id='new_trailer_path' placeholder='Nouveau trailer_path'>
        <label for='new_trailer_path'>Nouveau trailer_path</label>
    </div>
    <input type="submit" value="Mettre à jour le film">
    <input type="submit" name="delete_movie" value="Supprimer le film">


</form>
<script>
    document.addEventListener('DOMContentLoaded', function()
    {
        document.getElementById('add-person-btn').addEventListener('click', function()
        {
            let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
            add_person_modal.show();
        });
    });
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
        $new_title = $_POST['new_title'];
        $new_release_date = $_POST['new_release_date'];
        $new_synopsis = $_POST['new_synopsis'];
        $new_image_path = $_FILES['new_image_path']['name'];
        $new_image_tmp_path = $_FILES['new_image_path']['tmp_name'];
        $new_time_duration = $_POST['new_time_duration'];
        $new_note = $_POST['new_note'];
        $new_rating = $_POST['new_rating'];
        $new_trailer_path = $_POST['new_trailer_path'];


        // Traiter l'image si elle a été téléchargée
        $target_dir = "uploads/";
        $new_image_path = $target_dir . basename($new_image_path);

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
