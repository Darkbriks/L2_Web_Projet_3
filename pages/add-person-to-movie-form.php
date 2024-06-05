<?php
use mdb\MoviesDB;
use mdb\PersonDB;

$personDB = new PersonDB();
$persons = $personDB->getPersons(); // Récupère toutes les personnes existantes depuis la base de données
$movieDB = new MoviesDB();
$movies = $movieDB->getMovies(); // Récupère tous les films existants depuis la base de données
?>

    <div class="mb-3"><button type="button" class="btn btn-primary" id="add-link-btn"><?php echo $GLOBALS['update-form-link-title']; ?></button></div>

    <div class="modal fade" id="add-link-to-movie-modal" tabindex="-1" aria-labelledby="add-link-to-movie-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-link-to-movie-modal-label"><?php echo $GLOBALS['update-form-link-title']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' enctype='multipart/form-data' class="add-person-form">
                        <label for="movie_link_id"><?php echo $GLOBALS['update-movie-form-title']; ?></label>
                        <select name="movie_link_id" id="movie_link_id">
                            <?php foreach ($movies as $movie) { ?>
                                <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                            <?php } ?>
                        </select>
                        <label for="person_link_id"><?php echo $GLOBALS['person-form-title']; ?></label>
                        <select name="person_link_id" id="person_link_id">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?php echo $person->getId(); ?>"><?php echo $person->getFirstName() . " " . $person->getLastName(); ?></option>
                            <?php } ?>
                        </select>
                        <div class="mb-3">
                            <label for='link_value' hidden><?php echo $GLOBALS['person-form-type'] ?>></label>
                            <select class="form-select" name='link_value' id='link_value'>
                                <option value=''><?php echo $GLOBALS['person-form-type'] ?></option>
                                <option value='1'><?php echo $GLOBALS['movie-actor'] ?></option>
                                <option value='2'><?php echo $GLOBALS['movie-director'] ?></option>
                                <option value='3'><?php echo $GLOBALS['movie-composer'] ?></option>
                            </select>
                        </div>
                        <div class="form-floating mb-3" id="played-container" style="display: none;">
                            <input class="form-control" type='text' name='played' id='played' placeholder='<?php echo $GLOBALS['movie-form-add-played']; ?>'>
                            <label for='played'><?php echo $GLOBALS['movie-form-add-played']; ?></label>
                        </div>
                        <button class="btn btn-primary" id="tag-submit"><?php echo $GLOBALS['update-form-link']; ?></button>
                        <input type="submit" name="delete_link" value="<?php echo $GLOBALS['delete-form-link']; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-link-btn').addEventListener('click', function() {
                let add_person_modal = new bootstrap.Modal(document.getElementById('add-link-to-movie-modal'));
                add_person_modal.show();
            });

            document.getElementById('link_value').addEventListener('change', function() {
                let playedContainer = document.getElementById('played-container');
                if (this.value === '1') {
                    playedContainer.style.display = 'block';
                } else {
                    playedContainer.style.display = 'none';
                }
            });
        });
    </script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['person_link_id']) && isset($_POST['movie_link_id'])&& isset($_POST['link_value'])) {

    $person_link_id = $_POST['person_link_id'];
    $movie_link_id = $_POST['movie_link_id'];
    $type = $_POST['link_value'];

    if (isset($_POST['delete_link'])) {

        // Appeler la fonction pour supprimer le lien film/person spécifié
        $success = $personDB->deleteMoviePersonByAll($movie_link_id,$person_link_id, $type);

        if (!empty($success)) {
            echo "Le lien a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du lien.";
        }

        // Rediriger l'utilisateur vers la même page pour éviter la soumission multiple du formulaire
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

    }
    if ($type !==1) {
        // Valider le formulaire
        if (checkLinkValues($person_link_id, $movie_link_id, $type, null)) {

            // Si le formulaire est valide, vous pouvez maintenant procéder à la mise à jour de la personne dans la base de données
            $success = $personDB->addMovie_Person($movie_link_id, $person_link_id,null, $type);
            if (!empty($success)) {
                echo "Les informations de la personne ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations de la personne.";
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    else if (isset($_POST['played'])) {
        // Récupérer les valeurs des champs
        $played = $_POST['played'];


        // Valider le formulaire
        if (checkLinkValues($person_link_id, $movie_link_id, $type, $played)) {

            // Si le formulaire est valide, vous pouvez maintenant procéder à la mise à jour de la personne dans la base de données
            $success = $personDB->addMovie_Person($movie_link_id, $person_link_id,null, $type);
            if (!empty($success)) {
                echo "Les informations de la personne ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations de la personne.";
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    else if(isset($_POST['update_person_id'])) {
        // Afficher un message d'erreur si des champs requis sont manquants
        echo "Tous les champs requis doivent être remplis.";
    }
}

function checkLinkValues($person_link_id, $movie_link_id, $type, $played)
{
    // Vérification si tous les champs requis sont remplis
    if (empty($person_link_id) || empty($movie_link_id) || empty($type)) {
        echo "Tous les champs requis doivent être remplis.";
        return false;
    }

    // L'ID de la personne ne doit pas être vide et doit être un entier positif
    if (!is_numeric($person_link_id) || $person_link_id <= 0) {
        echo "L'ID de la personne doit être un entier positif.";
        return false;
    }

    // L'ID du film ne doit pas être vide et doit être un entier positif
    if (!is_numeric($movie_link_id) || $movie_link_id <= 0) {
        echo "L'ID du film doit être un entier positif.";
        return false;
    }

    // Le type du personnage ne doit pas être vide et doit être 1, 2, ou 3
    if (!in_array($type, [1, 2, 3])) {
        echo "Le type de lien doit être 1, 2, ou 3.";
        return false;
    }

    // Le rôle joué peut être vide mais doit contenir entre 3 et 50 caractères s'il est rempli
    $played = trim($played);
    if (!empty($played) && (strlen($played) < 3 || strlen($played) > 50)) {
        echo "Le rôle joué doit contenir entre 3 et 50 caractères.";
        return false;
    }
    return true;
}

?>