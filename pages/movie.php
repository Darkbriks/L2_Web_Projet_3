<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

$admin = $_SESSION['admin'] ?? false;
$img_file = $_FILES['image-path'] ?? null;
?>

<?php ob_start(); ?>

<div class="container movie-container">

<?php try
{


    if (!isset($_GET['id'])) { throw new Exception($GLOBALS['movie-error-1'], 1); }
    $id = (int)htmlspecialchars($_GET['id']);
    $moviesDB = new mdb\MoviesDB();
    $movies = $moviesDB->getMovieById($id);
    if (count($movies) == 0) { throw new Exception($GLOBALS['movie-error-2'] . $id, 2); }
    echo $movies[0]->getHtml($admin);

    $personDB = new mdb\PersonDB();
    $directors = $personDB->getDirectorsOfMovie($movies[0]->id);
    $actors = $personDB->getActorsOfMovie($movies[0]->id);
    $composers = $personDB->getComposersOfMovie($movies[0]->id);

    ?><h3><?php echo $GLOBALS['movie-directors'] ?></h3><div class="person-card-list"><?php foreach ($directors as $director) { echo $director->getHtml_card($admin, $movies[0]->id); }
    if ($admin) { echo mdb\form\GenerateFormInput::generateAddPersonCard('director'); } ?></div>

    <h3><?php echo $GLOBALS['movie-actors'] ?></h3> <div class="person-card-list"><?php foreach ($actors as $actor) { echo $actor->getHtml_card($admin, $movies[0]->id); }
    if ($admin) { echo mdb\form\GenerateFormInput::generateAddPersonCard('actor'); } ?></div>

    <h3><?php echo $GLOBALS['movie-composers'] ?></h3> <div class="person-card-list"><?php foreach ($composers as $composer) { echo $composer->getHtml_card($admin, $movies[0]->id); }
    if ($admin) { echo mdb\form\GenerateFormInput::generateAddPersonCard('composer'); } ?></div>

    <div class="modal fade" id="add-person-modal" tabindex="-1" aria-labelledby="add-person-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-person-modal-label"><?php echo $GLOBALS['person-form-title']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="add-person-modal-content">

                    <?php
                    echo mdb\form\GenerateFormInput::generateTextInput('person-first-name', $GLOBALS['person-form-add-person-first-name'], null, true);
                    echo mdb\form\GenerateFormInput::generateTextInput('person-last-name', $GLOBALS['person-form-add-person-last-name'], null, true);
                    echo mdb\form\GenerateFormInput::generateDateInput('person-birth-date', $GLOBALS['person-form-add-person-birth-date'], null, true);
                    echo mdb\form\GenerateFormInput::generateDateInput('person-death-date', $GLOBALS['person-form-add-person-death-date']);
                    ?>

                    <div id="add-person-role"></div>

                    <div class="mb-3">
                        <label for="person-image" class="form-label"><?php echo $GLOBALS['person-form-add-person-image']; ?></label>
                        <input class="form-control" type='file' name='person-image' id='person-image' required accept='image/jpeg, image/jpg, image/png'>
                    </div>

                    <button class="btn btn-primary" data-bs-dismiss="modal" id="person-submit"><?php echo $GLOBALS['person-form-add-person-submit']; ?></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            document.getElementById('add-card-director').addEventListener('click', function()
            {
                document.getElementById('add-person-role').innerHTML = "";
                document.getElementById('add-person-modal-content').dataset.personType = '2';
                let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
                add_person_modal.show();
            });

            document.getElementById('add-card-actor').addEventListener('click', function()
            {
                document.getElementById('add-person-role').innerHTML = '<?php echo mdb\form\GenerateFormInput::generateTextInput("person-role", "Role", null, true); ?>';
                document.getElementById('add-person-modal-content').dataset.personType = '1';
                let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
                add_person_modal.show();
            });

            document.getElementById('add-card-composer').addEventListener('click', function()
            {
                document.getElementById('add-person-role').innerHTML = "";
                document.getElementById('add-person-modal-content').dataset.personType = '3';
                let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
                add_person_modal.show();
            });

            document.getElementById('person-submit').addEventListener('click', function()
            {
                let formData = new FormData();
                let type = document.getElementById('add-person-modal-content').dataset.personType
                let role = document.getElementById('person-role')?.value ?? null;

                formData.append('addPerson', 'true');
                formData.append('first_name', document.getElementById('person-first-name').value);
                formData.append('last_name', document.getElementById('person-last-name').value);
                formData.append('birth_date', document.getElementById('person-birth-date').value);
                formData.append('death_date', document.getElementById('person-death-date').value);
                formData.append('personType', type);
                formData.append('role', role);
                formData.append('file', document.getElementById('person-image').files[0]);

                fetch('../api/add-person.php', { method: 'POST', body: formData })
                .then(response => { if (!response.ok) { set_user_msg('Erreur HTTP ! statut: ' + response.status, 'danger', document.getElementById('add-person-modal-content')); } return response.json(); })
                .then(data => { if (data.success) { emptyModal(); linkPersonToMovie(data.data, type, role); } else { set_user_msg(data.error, 'warning', document.getElementById('add-person-modal-content')); } })
                .catch(error => { set_user_msg(error, 'danger', document.getElementById('add-person-modal-content')); });
            });
        });

        function linkPersonToMovie(personId, personType, personRole)
        {
            let formData = new FormData();
            formData.append('addLink', 'true');
            formData.append('movieId', '<?php echo $movies[0]->id; ?>');
            formData.append('personId', personId);
            formData.append('personType', personType);
            formData.append('personRole', personRole);

            fetch('../api/set-movie-person-link.php', { method: 'POST', body: formData })
            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
            .then(data => { if (data.success) { location.reload(); } else { set_user_msg(data.error, 'warning'); } })
            .catch(error => { set_user_msg(error, 'danger'); });
        }

        function emptyModal()
        {
            document.getElementById('person-first-name').value = "";
            document.getElementById('person-last-name').value = "";
            document.getElementById('person-birth-date').value = "";
            document.getElementById('person-death-date').value = "";
            document.getElementById('person-image').value = "";
        }
    </script>

<?php }
catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger" }); </script> <?php } ?>

</div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content); ?>
