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

    <div class="modal fade" id="update-person-modal" tabindex="-1" aria-labelledby="update-person-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-person-modal-label">
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
                let add_person_modal = new bootstrap.Modal(document.getElementById('update-person-modal'));
                add_person_modal.show();
            });
        });
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