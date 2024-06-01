document.addEventListener('DOMContentLoaded', function()
{
    document.getElementById('posters').addEventListener('change', function()
    {
        let file = this.files[0];
        let reader = new FileReader();
        reader.onload = function(e)
        {
            document.getElementById('posters-preview').innerHTML = '<img src=\"' + e.target.result + '\" alt=\"' + file.name + '\">';
        };
        reader.readAsDataURL(file);
    });

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
                        // Ajouter le tag à la liste des catégories
                        let newCategory = document.createElement('div');
                        newCategory.innerHTML = '<input type=\"checkbox\" name=\"category[]\" id=\"category_' + response.id + '\" value=\"' + response.id + '\"><label for=\"category_' + response.id + '\">' + response.name + '</label>';
                        document.getElementById("categories").appendChild(newCategory);
                    }
                }
            };
        }
    });

    document.getElementById('AddDirectorButton').addEventListener('click', function()
    {
        let director = document.getElementById('directorDataList').value;
        if (director) { addPersonToMovieList(director, 'director', null); }
    });

    document.getElementById('AddActorButton').addEventListener('click', function()
    {
        let actor = document.getElementById('actorDataList').value;
        let role = document.getElementById('role').value;
        if (role.includes('!$!')) { alert('L\'expression !$! est réservée dans ce contexte, veuillez ne pas l\'utiliser.'); return; }
        if (actor && role) { addPersonToMovieList(actor, 'actor', role); }
    });

    document.getElementById('AddComposerButton').addEventListener('click', function()
    {
        let composer = document.getElementById('composerDataList').value;
        if (composer) { addPersonToMovieList(composer, 'composer', null); }
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

function addPersonToMovieList(person, type, role)
{
    let persons = document.querySelectorAll('.' + type + 'List input[type="hidden"]');
    for (let i = 0; i < persons.length; i++) { if (persons[i].id === person) { console.log('Person already added'); return; } }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../ajax/movieFormAddPerson.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('person=' + person);
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            let response = JSON.parse(xhr.responseText);
            if (response.success)
            {
                let data = JSON.parse(response.data);
                console.log(role);
                document.querySelector('.' + type + 'List').innerHTML += '<div><input type=\"hidden\" name=\"' + type + '[]\" value=\"' + data.id + (role !== null ? '!$!' + role : '') + '\" id=\"' + data.full_name + '\">' +
                '<label>' + data.full_name + (role !== null ? ' (' + role + ')' : '') + '</label><button type=\"button\" onclick=\"this.parentElement.remove();\">Remove</button></div>';
            }
            else { console.log('Erreur:', response.error); }
        }
    }
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