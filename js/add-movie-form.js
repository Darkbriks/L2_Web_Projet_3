document.addEventListener('DOMContentLoaded', function()
{
    document.getElementById('posters').addEventListener('change', function()
    {
        let file = this.files[0];
        if (file === undefined) { removePoster(); }

        let reader = new FileReader();
        reader.onload = function(e)
        {
            let img_container = document.getElementById('posters-preview');
            if (img_container === null) { img_container = document.getElementById('posters-preview-apply'); }
            else { img_container.id = 'posters-preview-apply'; }
            let img = img_container.querySelector('img');
            img.src = e.target.result; img.alt = file.name;
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('remove-poster-btn').addEventListener('click', removePoster);

    document.getElementById('addCategory').addEventListener('click', function()
    {
        let newCategory = document.getElementById('newCategory').value.trim();
        if (newCategory)
        {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../ajax/addTag.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('tag=' + newCategory);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200)
                {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success)
                    {
                        let newCategory = document.createElement('div');
                        newCategory.className = 'form-check';
                        newCategory.innerHTML = '<input class=\"form-check-input\" type=\"checkbox\" name=\"category[]\" id=\"category_' + response.id + '\" value=\"' + response.id + '\"><label class=\"form-check-label\" for=\"category_' + response.id + '\">' + response.name + '</label>';
                        document.getElementById("category").appendChild(newCategory);
                    }
                }
            };
        }
    });

    document.querySelector('form').addEventListener('submit', function(event)
    {
        let releaseDate = document.getElementById('release_date').value;
        let duration = parseInt(document.getElementById('duration').value);
        let category = document.querySelectorAll('input[name="category[]"]:checked');
        let currentDate = new Date().toISOString().split('T')[0];

        if (releaseDate === '' || releaseDate > currentDate) {
            showError('release_date', 'Please enter a valid release date');
            event.preventDefault();
        } else {
            hideError('release_date');
        }


        if (isNaN(duration) || duration <= 0) {
            showError('duration', 'Please enter a valid duration');
            event.preventDefault();
        } else {
            hideError('duration');
        }


        if (category.length === 0) {
            showError('category', 'Please select at least one category');
            event.preventDefault();
        } else {
            hideError('category');
        }

    });
});

function removePoster()
{
    let img_container = document.getElementById('posters-preview-apply');
    if (img_container === null) { img_container = document.getElementById('posters-preview'); }
    else { img_container.id = 'posters-preview'; }
    let img = img_container.querySelector('img');
    img.src = ''; img.alt = '';
    document.getElementById('posters').value = '';
}

function showError(fieldId, message) {
    let errorElement = document.getElementById(fieldId + '-error');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.id = fieldId + '-error';
        errorElement.className = 'error-message';
        let field = document.getElementById(fieldId);
        field.parentNode.insertBefore(errorElement, field.nextSibling);
    }
    errorElement.textContent = message;
}
function hideError(fieldId) {
    let errorElement = document.getElementById(fieldId + '-error');
    if (errorElement) {
        errorElement.parentNode.removeChild(errorElement);
    }
}