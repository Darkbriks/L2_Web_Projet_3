<?php

namespace mdb\data_template;

use mdb\form\GenerateFormInput;

class EditableObject
{
    // TODO: check localization
    public static function getHtml($id, $type): string
    {
        return "<div id='editModal' class='modal' tabindex='-1'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                      <h5 class='modal-title'>" . $GLOBALS['movie-edit'] . "</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        <div id='edit-modal-content' data-for='" . $type . "'></div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>" . $GLOBALS['cancel'] . "</button>
                        <button type='button' class='btn btn-primary' id='submit-modal'>" . $GLOBALS['save-changes'] . "</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function()
                    {
                        document.querySelectorAll('.editable').forEach(function(element)
                        {
                            element.addEventListener('click', function()
                            {
                                editObject(element.dataset.type, element.dataset.attribute);
                                let modal = new bootstrap.Modal(document.getElementById('editModal'));
                                modal.show();
                            });
                        });
                        
                        document.getElementById('submit-modal').addEventListener('click', function()
                        {
                            
                            let modalContent = document.getElementById('edit-modal-content');
                            
                            if (modalContent.querySelector('input[type=\"file\"]') !== null)
                            {
                                uploadFile(modalContent.querySelector('input[type=\"file\"]').files[0], modalContent.dataset.for);
                                return;
                            }
                            
                            let input = modalContent.querySelector('input');
                            let textarea = modalContent.querySelector('textarea');
                            
                            let value;
                            if (input !== null) { value = input.value; }
                            else if (textarea !== null) { value = textarea.value; }
                            else if (modalContent.querySelector('select') !== null) { value = modalContent.querySelector('select').value; }
                            else { console.log('Error: no input found'); }
                            
                            saveAttribute(modalContent.dataset.attribute, value);
                            let modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                            modal.hide();
                        });
                    });
                    
                    function uploadFile(file, type)
                    {
                        // Soummettre le fichier
                        let formData = new FormData();
                        formData.append('file', file);
                        formData.append('dir', (type === 'movie' ? 'uploads/posters/' : 'uploads/peoples/'));
                        /*fetch('../api/upload-file.php', { method: 'POST', body: formData })
                            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                            .then(data => { if (data.success) { set_user_msg(data.data, 'success', document.querySelector('.movie-container')); } else { set_user_msg(data.error, 'danger', document.querySelector('.movie-container')); } })
                            .catch(error => { set_user_msg(error, 'danger', document.querySelector('.movie-container')); });*/
                            
                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', '../api/upload-file.php', true);
                        xhr.onload = function() { if (xhr.status === 200) { set_user_msg(xhr.responseText, 'success', document.querySelector('.movie-container')); } else { set_user_msg(xhr.responseText, 'danger', document.querySelector('.movie-container')); } };
                        xhr.send(formData);
                    }
                </script>" . ($type === 'movie' ? self::moviePart($id) : self::personPart($id));
    }

    private static function moviePart($id): string
    {
        return "<script>
            function editObject(type, attribute)
            {
                let modalContent = document.getElementById('edit-modal-content');
            
                if (attribute === 'title') { modalContent.innerHTML = '" . GenerateFormInput::generateTextInput('title', $GLOBALS['movie-editable-new-title']) . "'; }
                else if (attribute === 'release_date') { modalContent.innerHTML = '" . GenerateFormInput::generateDateInput('release_date', $GLOBALS['movie-editable-new-release-date']) . "'; }
                else if (attribute === 'synopsis') { modalContent.innerHTML = '" . GenerateFormInput::generateTextareaInput('synopsis', $GLOBALS['movie-editable-new-synopsis']) . "'; }
                else if (attribute === 'time_duration') { modalContent.innerHTML = '" . GenerateFormInput::generateNumberInput('time_duration', $GLOBALS['movie-editable-new-time-duration']) . "'; }
                else if (attribute === 'note') { modalContent.innerHTML = '" . GenerateFormInput::generateNumberInput('note', $GLOBALS['movie-editable-new-note']) . "'; }
                else if (attribute === 'rating') { modalContent.innerHTML = '" . GenerateFormInput::generateSelectInput('rating', $GLOBALS['movie-editable-new-rating'], ['1' => $GLOBALS['movie-form-add-movie-age-rating-all'], '10' => '10 ' . $GLOBALS['movie-form-add-movie-age-rating-number'], '12' => '12 ' . $GLOBALS['movie-form-add-movie-age-rating-number'], '16' => '16 ' . $GLOBALS['movie-form-add-movie-age-rating-number'], '18' => '18 ' . $GLOBALS['movie-form-add-movie-age-rating-number']]) . "'; }
                // TODO: Affiche & Trailer
                else { modalContent.innerHTML = '<p>" . $GLOBALS['error-unknown-type'] . "</p>'; }
                
                modalContent.dataset.attribute = attribute;
            }
            
            function saveAttribute(name, value)
            {
                fetch('../api/set-movie-attribute.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'id': '" . $id . "', 'attribute': name, 'value': value }) })
                    .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                    .then(data => { if (data.success)
                    {
                        set_user_msg(data.data, 'success', document.querySelector('.movie-container'));
                        document.querySelector('.editable[data-attribute=\"' + name + '\"]').innerText = value;
                        if (name === 'rating') { document.querySelector('.editable[data-attribute=\"' + name + '\"]').innerText = (value <= 1 ? '" . $GLOBALS['movie-rating-1'] . "' : value + ' " . $GLOBALS['movie-rating-2'] . "'); }
                    }
                    else { set_user_msg(data.error, 'danger', document.querySelector('.movie-container')); } })
                    .catch(error => { set_user_msg(error, 'danger', document.querySelector('.movie-container')); });
            }
            </script>";
    }

    private static function personPart($id): string
    {
        return "<script>
            function editObject(type, attribute)
            {
                let modalContent = document.getElementById('edit-modal-content');
                            
                // TODO: create and localize texts
                if (attribute === 'first_name') { modalContent.innerHTML = '" . GenerateFormInput::generateTextInput('first_name', $GLOBALS['movie-editable-new-title']) . "'; }
                else if (attribute === 'last_name') { modalContent.innerHTML = '" . GenerateFormInput::generateTextInput('last_name', $GLOBALS['movie-editable-new-release-date']) . "'; }
                else if (attribute === 'birth_date') { modalContent.innerHTML = '" . GenerateFormInput::generateDateInput('birth_date', $GLOBALS['movie-editable-new-synopsis']) . "'; }
                else if (attribute === 'death_date') { modalContent.innerHTML = '" . GenerateFormInput::generateDateInput('death_date', $GLOBALS['movie-editable-new-time-duration']) . "'; }
                else if (attribute === 'image_path') { modalContent.innerHTML = '" . GenerateFormInput::generateFileInput('image_path', $GLOBALS['movie-editable-new-note']) . "'; }
                else { modalContent.innerHTML = '<p>" . $GLOBALS['error-unknown-type'] . "</p>'; }
                modalContent.dataset.attribute = attribute;
            }
            
            function saveAttribute(name, value)
            {
                fetch('../api/set-person-attribute.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'id': '" . $id . "', 'attribute': name, 'value': value }) })
                    .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                    .then(data => { if (data.success)
                    {
                        set_user_msg(data.data, 'success');
                        document.querySelector('.editable[data-attribute=\"' + name + '\"]').innerText = value;
                        if (name === 'first_name') { document.getElementById('full_name').innerText = value + ' ' + document.querySelector('.editable[data-attribute=\"last_name\"]').innerText; }
                        else if (name === 'last_name') { document.getElementById('full_name').innerText = document.querySelector('.editable[data-attribute=\"first_name\"]').innerText + ' ' + value; }
                    }
                    else { set_user_msg(data.error, 'danger'); } })
                    .catch(error => { set_user_msg(error, 'danger'); });
            }
            </script>";
    }
}