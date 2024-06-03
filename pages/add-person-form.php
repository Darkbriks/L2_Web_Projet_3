<div class="mb-3"><button type="button" class="btn btn-primary" id="add-person-btn">Ajouter une personne</button></div>

<div class="modal fade" id="add-person-modal" tabindex="-1" aria-labelledby="add-person-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-person-modal-label"><?php echo $GLOBALS['person-form-title']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' enctype='multipart/form-data' class="add-person-form">

                    <div id="add-person-form-msg">
                        <?php if (isset($add_person_error)) { echo "<div class='alert alert-warning' role='alert'>$add_person_error</div>"; } ?>
                        <?php if (isset($add_person_success)) { echo "<div class='alert alert-success' role='alert'>$add_person_success</div>"; } ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name='person-first-name' id="person-first-name" required placeholder='<?php echo $GLOBALS['person-form-add-person-first-name']; ?>'>
                        <label for="person-first-name"><?php echo $GLOBALS['person-form-add-person-first-name']; ?></label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name='person-last-name' id="person-last-name" required placeholder='<?php echo $GLOBALS['person-form-add-person-last-name']; ?>'>
                        <label for="person-last-name"><?php echo $GLOBALS['person-form-add-person-last-name']; ?></label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type='date' name='person-birth-date' id='person-birth-date' required>
                        <label for='person-birth-date'><?php echo $GLOBALS['person-form-add-person-birth-date']; ?></label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type='date' name='person-death-date' id='person-death-date'>
                        <label for='person-death-date'><?php echo $GLOBALS['person-form-add-person-death-date']; ?></label>
                    </div>

                    <div class="mb-3">
                        <label for="person-image" class="form-label"><?php echo $GLOBALS['person-form-add-person-image']; ?></label>
                        <input class="form-control" type='file' name='person-image' id='person-image' required accept='image/jpeg, image/jpg, image/png'>
                    </div>

                    <button class="btn btn-primary" id="person-submit"><?php echo $GLOBALS['person-form-add-person-submit']; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function()
{
    document.getElementById('add-person-btn').addEventListener('click', function()
    {
        let add_person_modal = new bootstrap.Modal(document.getElementById('add-person-modal'));
        add_person_modal.show();
    });

    document.querySelector('#person-submit').addEventListener('submit', function(e)
    {
        document.getElementById('add-person-form-msg').innerHTML = '';
        e.preventDefault();
        if (validateForm()) { document.querySelector('.add-person-form').submit(); }
    });
});

function checkForm()
{
    let form = document.querySelector('.add-person-form');
    let name = form.querySelector('#person-first-name').value;
    let surname = form.querySelector('#person-last-name').value;
    let birthDate = form.querySelector('#person-birth-date').value;
    let deathDate = form.querySelector('#person-death-date').value;
    let image = form.querySelector('#person-image').value

    // Le nom ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    name = name.trim(); if (name.length < 3 || name.length > 50) { showPersonFormMsg("<?php echo $GLOBALS['person-form-exception-first-name']; ?>", "warning"); return false; }

    // Le nom de famille ne doit pas être vide, et doit contenir entre 3 et 50 caractères
    surname = surname.trim(); if (surname.length < 3 || surname.length > 50) { showPersonFormMsg("<?php echo $GLOBALS['person-form-exception-last-name']; ?>", "warning"); return false; }

    // La date de naissance ne doit pas être vide et doit être une date passée
    birthDate = birthDate.trim(); if (!birthDate) { showPersonFormMsg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning"); return false; }
    if (new Date(birthDate) > new Date()) { showPersonFormMsg("<?php echo $GLOBALS['person-form-exception-birth-date']; ?>", "warning"); return false; }

    // La date de décès doit être vide ou une date passée
    deathDate = deathDate.trim(); if (deathDate && new Date(deathDate) > new Date()) { showPersonFormMsg("<?php echo $GLOBALS['person-form-exception-death-date']; ?>", "warning"); return false; }

    // L'affiche ne doit pas être vide, et doit être une image (jpg, jpeg, png)
    image = image.trim(); if (image.length === 0) { showMovieFormMsg("<?php echo $GLOBALS['person-form-exception-image']; ?>", "warning"); return false; }

    return true;
}

function showPersonFormMsg(msg, type)
{
    let form_msg = document.getElementById('add-person-form-msg');
    form_msg.innerHTML = '<div class="alert alert-' + type + '" role="alert">' + msg + '</div>';
    console.log(msg);
}
</script>