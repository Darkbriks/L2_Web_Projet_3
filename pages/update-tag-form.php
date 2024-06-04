<?php
use mdb\tagDB;

$tagDB = new \mdb\TagDB();
$tags = $tagDB->getTags(); // Récupère toutes les tag existantes depuis la base de données
?>

    <div class="mb-3"><button type="button" class="btn btn-primary" id="add-tag-btn"><?php echo $GLOBALS['update-tag-form-title']; ?></button></div>

    <div class="modal fade" id="add-tag-modal" tabindex="-1" aria-labelledby="add-tag-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-tag-modal-label"><?php echo $GLOBALS['update-tag-form-title']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' enctype='multipart/form-data' class="add-tag-form">
                        <label for="tag_id"><?php echo $GLOBALS['update-tag-form-question']; ?></label>
                        <select name="tag_id" id="tag_id">
                            <?php foreach ($tags as $tag) { ?>
                                <option value="<?php echo $tag->getId(); ?>"><?php echo $tag->getName() ?></option>
                            <?php } ?>
                        </select>
                        <div id="add-tag-form-msg">
                            <?php if (isset($add_tag_error)) { echo "<div class='alert alert-warning' role='alert'>$add_tag_error</div>"; } ?>
                            <?php if (isset($add_tag_success)) { echo "<div class='alert alert-success' role='alert'>$add_tag_success</div>"; } ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name='new_name' id="tag-name"  placeholder='<?php echo $GLOBALS['update-tag-form-name']; ?>'>
                            <label for="tag-name"><?php echo $GLOBALS['update-tag-form-name']; ?></label>
                        </div>
                        <button class="btn btn-primary" id="tag-submit"><?php echo $GLOBALS['update-tag-form-title']; ?></button>
                        <input type="submit" name="delete_tag" value="<?php echo $GLOBALS['delete-tag-form']; ?>">

                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function()
    {
        document.getElementById('add-tag-btn').addEventListener('click', function()
        {
            let add_person_modal = new bootstrap.Modal(document.getElementById('add-tag-modal'));
            add_person_modal.show();
        });
    });
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tag_id'])) {

    $tag_id = $_POST['tag_id'];

    if (isset($_POST['delete_tag'])) {
        // Vérifier si l'ID du tag à supprimer est présent dans la requête

        // Appeler la fonction pour supprimer le tag avec l'ID spécifié
        $success = $tagDB->deleteTagAndRelationsById( $tag_id);

        if (!empty($success)) {
            echo "Le tag a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du tag.";
        }

        // Rediriger l'utilisateur vers la même page pour éviter la soumission multiple du formulaire
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (
        isset($_POST['new_name'])
    ) {
        // Récupérer les valeurs des champs
        $new_name = $_POST['new_name'];

        // Valider le formulaire
        if (checkTagValues($tag_id, $new_name)) {

            // Si le formulaire est valide, vous pouvez maintenant procéder à la mise à jour de la tag dans la base de données
            $success = $tagDB->alterTag($tag_id, $new_name);
            if (!empty($success)) {
                echo "Les informations de la tag ont été mises à jour avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la mise à jour des informations de la tag.";
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

function checkTagValues($tag_id, $new_name): bool
{
    // Vérification si tous les champs requis sont remplis
    if (empty($tag_id) || empty($new_name)) {
        echo "Tous les champs requis doivent être remplis.";
        return false;
    }

    // Le prénom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    $new_first_name = trim($new_name);
    if (strlen($new_first_name) < 3 || strlen($new_first_name) > 50) {
        echo "Le prénom doit contenir entre 3 et 50 caractères.";
        return false;
    }


    return true;
}
?>
