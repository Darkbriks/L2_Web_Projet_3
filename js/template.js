document.addEventListener('DOMContentLoaded', function()
{
    changeTheme(localStorage.getItem('theme') || 'dark')

    document.getElementById('theme-dropdown').querySelectorAll('.dropdown-item').forEach(function(button)
    {
        button.addEventListener('click', function() { changeTheme(button.value); });
    });

    document.getElementById('language-dropdown').querySelectorAll('.dropdown-item').forEach(function(button)
    {
        button.addEventListener('click', function() { setLanguage(button.textContent); });
    });

    document.getElementById('search').addEventListener('input', function() { search(this.value); });
});

function search(value)
{
    if (value.length === 0) { document.getElementById("search-list").innerHTML = ''; return; }

    let movies = null;
    let persons = null;

    fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'movies', 'conditionLength': '1', 'attribute0': 'title', 'value0': value, 'limit': '3', 'useLike': 'true' }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { movies = JSON.parse(data.data); if (persons !== null) { displaySearchResults(movies, persons); } } else { console.log('Erreur:', data.error); } })
        .catch(error => { console.log('Erreur:', error); });

    fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'person', 'conditionLength': '2', 'attribute0': 'first_name', 'value0': value, 'attribute1': 'last_name', 'value1': value, 'limit': '3', 'useLike': 'true' }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { persons = JSON.parse(data.data); if (movies !== null) { displaySearchResults(movies, persons); } } else { console.log('Erreur:', data.error); } })
        .catch(error => { console.log('Erreur:', error); });
}

function displaySearchResults(movies, persons)
{
    let resultList = document.getElementById("search-list");
    resultList.innerHTML = '';

    movies.forEach(function (movie)
    {
        let option = document.createElement('button');
        option.classList.add('list-group-item', 'list-group-item-action');
        option.innerHTML = movie.title + ' (' + movie.release_date + ')';
        option.id = movie.id;
        option.addEventListener('click', function () { window.location.href = 'movie.php?id=' + movie.id; });
        resultList.appendChild(option);
    });

    persons.forEach(function (person)
    {
        let option = document.createElement('button');
        option.classList.add('list-group-item', 'list-group-item-action');
        option.innerHTML = person.first_name + ' ' + person.last_name;
        option.id = person.id;
        option.addEventListener('click', function () {
            window.location.href = 'person.php?id=' + person.id;
        });
        resultList.appendChild(option);
    });
}

function setLanguage(newLanguage)
{
    fetch('../api/language.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'method': 'set', 'language': newLanguage }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { location.reload(); } else { console.log('Erreur:', data.error); } })
        .catch(error => { console.log('Erreur:', error); });
}

function set_user_msg(msg, type="info", element=null)
{
    let msg_div = document.createElement('div');
    msg_div.classList.add('alert', 'alert-' + type);
    msg_div.textContent = msg;
    if (element === null) { document.getElementById('content').prepend(msg_div); }
    else { element.prepend(msg_div); }
}

function getLocalizedText(key)
{
    fetch('../api/get-localized-text.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'text': key }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { return data.localizedText; } else { console.log('Erreur:', data.error); } })
        .catch(error => { console.log('Erreur:', error); });
}