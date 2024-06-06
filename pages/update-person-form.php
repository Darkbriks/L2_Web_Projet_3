<?php
use mdb\PersonDB;

try
{
    $personDB = new PersonDB();
    $persons = $personDB->getPersons();
}
catch (Exception $e) { echo "Erreur:" . $e->getMessage(); }
?>

    <button type="button" class="btn btn-primary" id="update-person-btn">
        <?php echo htmlspecialchars($GLOBALS['update-person-form-title'], ENT_QUOTES, 'UTF-8'); ?>
    </button>

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
                            <input type="text" class="form-control" name='person-first-name' id="person-first-name" placeholder='<?php echo htmlspecialchars($GLOBALS['person-form-add-person-first-name'], ENT_QUOTES, 'UTF-8'); ?>'>
                            <label for="person-first-name">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-first-name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='person-last-name' id="person-last-name" placeholder='<?php echo htmlspecialchars($GLOBALS['person-form-add-person-last-name'], ENT_QUOTES, 'UTF-8'); ?>'>
                            <label for="person-last-name">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-last-name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='person-birth-date' id='person-birth-date'>
                            <label for='person-birth-date'>
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-birth-date'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='person-death-date' id='person-death-date'>
                            <label for='person-death-date'>
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-death-date'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="person-image" class="form-label">
                                <?php echo htmlspecialchars($GLOBALS['person-form-add-person-image'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <input class="form-control" type='file' name='person-image-path' id='person-image-path' accept='image/jpeg, image/jpg, image/png'>
                        </div>

                        <button class="btn btn-primary" id="update-person-submit">
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

        document.querySelector('#update-person-submit').addEventListener('submit', function(e) {
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
            if (name.length < 10 || name.length > 50) {
                set_user_msg("<?php echo addslashes($GLOBALS['person-form-exception-first-name']); ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }

            // Le nom de famille ne doit pas être vide, et doit contenir entre 3 et 50 caractères
            surname = surname.trim();
            if (surname.length < 3 || surname.length > 50) {
                set_user_msg("<?php echo $GLOBALS['person-form-exception-last-name']; ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }

            // La date de naissance ne doit pas être vide et doit être une date passée
            birthDate = birthDate.trim();
            if (!birthDate) {
                set_user_msg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }
            if (new Date(birthDate) > new Date()) {
                set_user_msg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }

            // La date de décès doit être vide ou une date passée
            deathDate = deathDate.trim();
            if (deathDate && new Date(deathDate) > new Date()) {
                set_user_msg("<?php echo $GLOBALS['person-form-exception-death-date']; ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }

            // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
            image = image.trim();
            if (image.length === 0) {
                set_user_msg("<?php echo $GLOBALS['person-form-exception-image']; ?>", "warning", document.getElementById('update-person-form-msg'));
                return false;
            }

            return true;
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
}
?>