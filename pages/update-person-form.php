<?php
use mdb\PersonDB;

$personDB = new PersonDB();
$persons = $personDB->getPersons(); // Récupère toutes les personnes existantes depuis la base de données
?>

    <div class="mb-3"><button type="button" class="btn btn-primary" id="add-person-btn">Modifier une personne</button></div>

    <div class="modal fade" id="add-person-modal" tabindex="-1" aria-labelledby="add-person-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-person-modal-label">Modifier une personne</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' enctype='multipart/form-data' class="add-person-form">
                        <label for="update_person_id">Choisir une personne à mettre à jour :</label>
                        <select name="update_update_person_id" id="update_person_id">
                            <?php foreach ($persons as $person) { ?>
                                <option value="<?php echo $person->getId(); ?>"><?php echo $person->getFirstName() . " " . $person->getLastName(); ?></option>
                            <?php } ?>
                        </select>
                        <div id="add-person-form-msg">
                            <?php if (isset($add_person_error)) { echo "<div class='alert alert-warning' role='alert'>$add_person_error</div>"; } ?>
                            <?php if (isset($add_person_success)) { echo "<div class='alert alert-success' role='alert'>$add_person_success</div>"; } ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='new_first_name' id="person-first-name"  placeholder='<?php echo $GLOBALS['person-form-add-person-first-name']; ?>'>
                            <label for="person-first-name"><?php echo $GLOBALS['person-form-add-person-first-name']; ?></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='new_last_name' id="person-last-name"  placeholder='<?php echo $GLOBALS['person-form-add-person-last-name']; ?>'>
                            <label for="person-last-name"><?php echo $GLOBALS['person-form-add-person-last-name']; ?></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='new_birth_date' id='person-birth-date' >
                            <label for='person-birth-date'><?php echo $GLOBALS['person-form-add-person-birth-date']; ?></label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" type='date' name='new_death_date' id='person-death-date'>
                            <label for='person-death-date'><?php echo $GLOBALS['person-form-add-person-death-date']; ?></label>
                        </div>

                        <div class="mb-3">
                            <label for="person-image" class="form-label"><?php echo $GLOBALS['person-form-add-person-image']; ?></label>
                            <input class="form-control" type='file' name='new_image_path' id='person-image'  accept='image/jpeg, image/jpg, image/png'>
                        </div>

                        <button class="btn btn-primary" id="person-submit"><?php echo $GLOBALS['person-form-add-person-submit']; ?></button>
                        <input type="submit" name="delete_person" value="Supprimer la personne">

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_person_id'])) {

    $update_person_id = $_POST['update_person_id'];

    if (isset($_POST['delete_person'])) {
    // Vérifier si l'ID du personnage à supprimer est présent dans la requête

        // Appeler la fonction pour supprimer la personne avec l'ID spécifié
        $success = $personDB->deletePersonAndRelationsById( $update_person_id);

        if (!empty($success)) {
            echo "Le personnage a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du personnage.";
        }

        // Rediriger l'utilisateur vers la même page pour éviter la soumission multiple du formulaire
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (
        isset($_POST['new_first_name']) &&
        isset($_POST['new_last_name']) &&
        isset($_POST['new_birth_date']) &&
        isset($_POST['new_death_date']) &&
        isset($_FILES['new_image_path'])
    ) {
        // Récupérer les valeurs des champs
        $person_id = htmlspecialchars(trim($_POST['person-id']));
        $new_first_name = htmlspecialchars(trim($_POST['person-first-name']));
        $new_last_name = htmlspecialchars(trim($_POST['person-last-name']));
        $new_birth_date = htmlspecialchars(trim($_POST['person-birth-date']));
        $new_death_date = !empty($_POST['person-death-date']) ? htmlspecialchars(trim($_POST['person-death-date'])) : null;
        $new_image_name = '';

        if (!empty($_FILES['person-image']['name'])) {
            $img_file = $_FILES['person-image'];
            $tmp_name = $img_file['tmp_name'];
            $img_name = $img_file['name'];
            $img_name = urldecode(htmlspecialchars($img_name));
            $dir = $GLOBALS['PHP_DIR'] . 'uploads/peoples/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            if (move_uploaded_file($tmp_name, $dir . $img_name)) {
                $new_image_name = $img_name;
            } else {
                $update_error = $GLOBALS['person-form-exception-upload'];
            }
        }

        // Valider le formulaire
        if (checkValues($update_person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_name)) {

            // Si le formulaire est valide, vous pouvez maintenant procéder à la mise à jour de la personne dans la base de données
            $success = $personDB->alterPerson($update_person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_name);
            if (!empty($success)) {
                echo "Les informations de la personne ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations de la personne.";
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

function checkValues($update_person_id, $new_first_name, $new_last_name, $new_birth_date, $new_death_date, $new_image_name)
{
    // Vérification si tous les champs requis sont remplis
    if (empty($update_person_id) || empty($new_first_name) || empty($new_last_name) || empty($new_birth_date) || empty($new_image_name)) {
        echo "Tous les champs requis doivent être remplis.";
        return false;
    }

    // Le prénom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    $new_first_name = trim($new_first_name);
    if (strlen($new_first_name) < 3 || strlen($new_first_name) > 50) {
        echo "Le prénom doit contenir entre 3 et 50 caractères.";
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
