<div class="mb-3"><button type="button" class="btn btn-outline-primary" id="add-person-btn"><?php echo $GLOBALS['person-form-title']?></button></div>

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
        document.querySelector('.add-person-form').addEventListener('submit', function (e) {
            console.log('bbbbbbb');
            if (document.getElementById('add-person-form-msg')) {
                document.getElementById('add-person-form-msg').innerHTML = '';
                e.preventDefault();
                if (checkPersonForm('.add-person-form','add-person-form-msg')) {
                    document.querySelector('.add-person-form').submit();
                }
            }
        });
    });
</script>