<?php
use mdb\PersonDB;

$personDB = new PersonDB();
$persons = $personDB->getPersons(); // Récupère toutes les personnes existantes depuis la base de données
?>

    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="update-person-btn">
            <?php echo htmlspecialchars($GLOBALS['update-person-form-title'], ENT_QUOTES, 'UTF-8'); ?>
        </button>
    </div>

    <div class="modal fade" id="add-person-modal" tabindex="-1" aria-labelledby="add-person-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-person-modal-label">
                        <?php echo htmlspecialchars($GLOBALS['update-person-form-title'], ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' enctype='multipart/form-data' class="update-person-form">
                        <label for="person_id">
                            <?php echo htmlspecialchars($GLOBALS['update-person-form-question'], ENT_QUOTES, 'UTF-8'); ?>
                        </label>
                        <select name="person_id" id="person_id">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?php echo $person->getId(); ?>">
                                    <?php echo htmlspecialchars($person->getFirstName() . " " . $person->getLastName(), ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div id="update-person-form-msg">
                            <?php if (isset($add_person_error)) { echo "<div class='update-person-alert alert-warning' role='alert'>" . htmlspecialchars($add_person_error, ENT_QUOTES, 'UTF-8') . "</div>"; } ?>
                            <?php if (isset($add_person_success)) { echo "<div class='update-person-alert alert-success' role='alert'>" . htmlspecialchars($add_person_success, ENT_QUOTES, 'UTF-8') . "</div>"; } ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='new_first_name' id="person-first-name" placeholder='<?php echo htmlspecialchars($GLOBALS['person-form-add-person-first-name'], ENT_QUOTES, 'UTF-8'); ?>'>
                            <label for="person-first-name">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-first-name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='new_last_name' id="person-last-name" placeholder='<?php echo htmlspecialchars($GLOBALS['person-form-add-person-last-name'], ENT_QUOTES, 'UTF-8'); ?>'>
                            <label for="person-last-name">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-last-name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='new_birth_date' id='person-birth-date'>
                            <label for='person-birth-date'>
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-birth-date'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='new_death_date' id='person-death-date'>
                            <label for='person-death-date'>
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-death-date'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="person-image" class="form-label">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-image'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <input class="form-control" type='file' name='new_image_path' id='person-image' accept='image/jpeg, image/jpg, image/png'>
                        </div>

                        <button class="btn btn-primary" id="person-submit">
                            <?php echo htmlspecialchars($GLOBALS['update-person-form-submit'], ENT_QUOTES, 'UTF-8'); ?>
                        </button>
                        <input type="submit" name="delete_person" value="<?php echo htmlspecialchars($GLOBALS['delete-person-form'], ENT_QUOTES, 'UTF-8'); ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('update-person-btn').addEventListener('click', function() {
                let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
                add_person_modal.show();
            });
        });

        document.querySelector('.update-person-form').addEventListener('submit', function(e) {
            document.getElementById('update-person-form-msg').innerHTML = '';
            e.preventDefault();
            if (validatePersonForm()) {
                document.querySelector('.update-person-form').submit();
            }
        });

        function validatePersonForm() {
            let form = document.querySelector('.update-person-form');
            let name = form.querySelector('#person-first-name').value;
            let surname = form.querySelector('#person-last-name').value;
            let birthDate = form.querySelector('#person-birth-date').value;
            let deathDate = form.querySelector('#person-death-date').value;
            let image = form.querySelector('#person-image').value;

            // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
            name = name.trim();
            if (name.length < 3 || name.length > 50) {
                showFormMsg("<?php echo addslashes($GLOBALS['person-form-exception-first-name']); ?>", "warning");
                return false;
            }

            // Le nom de famille ne doit pas être vide, et doit contenir entre 3 et 50 caractères
            surname = surname.trim();
            if (surname.length < 3 || surname.length > 50) {
                showFormMsg("<?php echo $GLOBALS['person-form-exception-last-name']; ?>", "warning");
                return false;
            }

            // La date de naissance ne doit pas être vide et doit être une date passée
            birthDate = birthDate.trim();
            if (!birthDate) {
                showFormMsg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning");
                return false;
            }
            if (new Date(birthDate) > new Date()) {
                showFormMsg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning");
                return false;
            }

            // La date de décès doit être vide ou une date passée
            deathDate = deathDate.trim();
            if (deathDate && new Date(deathDate) > new Date()) {
                showFormMsg("<?php echo $GLOBALS['person-form-exception-death-date']; ?>", "warning");
                return false;
            }

            // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
            /*image = image.trim();
            if (image.length === 0) {
                showFormMsg("<?php echo $GLOBALS['person-form-exception-image']; ?>", "warning");
                return false;
            }*/

            return true;
        }

        function showFormMsg(msg, type) {
            let form_msg = document.getElementById('update-person-form-msg');
            form_msg.innerHTML = '<div class="update-person-alert alert-' + type + '" role="alert">' + msg + '</div>';
            console.log(msg);
        }
    </script>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['delete_person'])) {
        // Vérifier si l'ID du film à supprimer est présent dans la requête
        if (isset($_POST['person_id'])) {
            $movie_id = $_POST['person_id'];

            // Appeler la fonction pour supprimer le film avec l'ID spécifié
            $success = $personDB->deletePersonAndRelationsById( $_POST['person_id']);

            if ($success) {
                echo "Le personnage a été supprimé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la suppression du personnage.";
            }

            // Rediriger l'utilisateur vers la même page pour éviter la soumission multiple du formulaire
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    if (
        isset($_POST['person_id']) &&
        isset($_POST['new_first_name']) &&
        isset($_POST['new_last_name']) &&
        isset($_POST['new_birth_date']) &&
        isset($_POST['new_death_date']) &&
        isset($_FILES['new_image_path'])
    ) {
        // Récupérer les valeurs des champs
        $person_id = $_POST['person_id'];
        $new_first_name = $_POST['new_first_name'];
        $new_last_name = $_POST['new_last_name'];
        $new_birth_date = $_POST['new_birth_date'];
        $new_death_date = $_POST['new_death_date'];
        $new_image_name = $_FILES['new_image_path']['name'];
        $new_image_tmp_path = $_FILES['new_image_path']['tmp_name'];

        // Définir le chemin où l'image sera stockée sur le serveur
        $target_dir = "uploads/";
        $new_image_path = $target_dir . basename($new_image_name);

        // Traiter l'image si elle a été téléchargée
        if ($_FILES['new_image_path']['size'] > 0) {
            // Déplacer l'image téléchargée vers le dossier d'uploads
            move_uploaded_file($new_image_tmp_path, $new_image_path);
        }

        // Valider le formulaire
        if (checkValues($person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_name)) {

            // Si le formulaire est valide, vous pouvez maintenant procéder à la mise à jour de la personne dans la base de données
            $success = $personDB->alterPerson($person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_path);
            if (!empty($success)) {
                echo "Les informations de la personne ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations de la personne.";
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    else if(isset($_POST['person_id'])) {
        // Afficher un message d'erreur si des champs requis sont manquants
        echo "Tous les champs requis doivent être remplis.";
    }
}

function checkValues($person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_name)
{
    // Vérification si tous les champs requis sont remplis
    if (empty($person_id) || empty($new_first_name) || empty($new_last_name) || empty($new_birth_date) || empty($new_image_name)) {
        echo "Tous les champs requis doivent être remplis.";
        return false;
    }

    // Le prénom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    $new_first_name = trim($new_first_name);
    if (strlen($new_first_name) < 3 || strlen($new_first_name) > 50) {
        echo "Le prénom doit contenir entre 3 et 50 caractères eadaedaz.";
        return false;
    }

    // Le nom de famille ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    $new_last_name = trim($new_last_name);
    if (strlen($new_last_name) < 3 || strlen($new_last_name) > 50) {
        echo "Le nom de famille doit contenir entre 3 et 50 caractères.";
        return false;
    }

    // La date de naissance ne doit pas être vide, et doit être au format YYYY-MM-DD
    $new_birth_date = trim($new_birth_date);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $new_birth_date)) {
        echo "La date de naissance doit être au format YYYY-MM-DD.";
        return false;
    }

    // La date de décès doit être vide ou au format YYYY-MM-DD
    if (!empty($new_death_date) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $new_death_date)) {
        echo "La date de décès doit être au format YYYY-MM-DD.";
        return false;
    }

    // Ajoutez ici d'autres validations si nécessaire

    return true;
}
?>