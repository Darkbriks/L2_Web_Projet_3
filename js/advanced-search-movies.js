function searchMovies()
{
    let title = document.getElementById('filter-movie-title').value;
    let titleOperator = document.getElementById('operator-movie-title').value;
    let release = document.getElementById('filter-movie-release').value;
    let releaseOperator = document.getElementById('operator-movie-release').value;
    let duration = document.getElementById('filter-movie-duration').value;
    let durationOperator = document.getElementById('operator-movie-duration').value;
    let rating = document.getElementById('filter-movie-rating').value;
    let ratingOperator = document.getElementById('operator-movie-rating').value;
    let note = document.getElementById('filter-movie-note').value;
    let noteOperator = document.getElementById('operator-movie-note').value;
    let seen = document.getElementById('operator-movie-seen').value;
    let synopsis = document.getElementById('filter-movie-synopsis').value;
    let synopsisOperator = document.getElementById('operator-movie-synopsis').value;

    let directors = [];
    document.getElementById('directorList').querySelectorAll('.person-id-value').forEach(function(director) { directors.push(director.value); });
    let directorOperator = document.getElementById('operator-director').value;

    let actors = [];
    document.getElementById('actorList').querySelectorAll('.person-id-value').forEach(function(actor) { actors.push(actor.value); });
    let actorOperator = document.getElementById('operator-actor').value;

    let composers = [];
    document.getElementById('composerList').querySelectorAll('.person-id-value').forEach(function(composer) { composers.push(composer.value); });
    let composerOperator = document.getElementById('operator-composer').value;

    let tags = [];
    document.getElementById('category').querySelectorAll('input[type="checkbox"]').forEach(function(tag) { if (tag.checked) { tags.push(tag.value); } });
    let tagsOperator = document.getElementById('operator-movie-tag').value;

    let data = {
        'title': title,
        'titleOperator': titleOperator,
        'release': release,
        'releaseOperator': releaseOperator,
        'duration': duration,
        'durationOperator': durationOperator,
        'rating': rating,
        'ratingOperator': ratingOperator,
        'note': note,
        'noteOperator': noteOperator,
        'seen': seen,
        'synopsis': synopsis,
        'synopsisOperator': synopsisOperator,
        'nbDirectors': directors.length,
        'directorsOperator': directorOperator,
        'nbActors': actors.length,
        'actorsOperator': actorOperator,
        'nbComposers': composers.length,
        'composersOperator': composerOperator,
        'nbTags': tags.length,
        'tagsOperator': tagsOperator
    };

    directors.forEach(function(director, index) { data['director' + index] = director; });
    actors.forEach(function(actor, index) { data['actor' + index] = actor; });
    composers.forEach(function(composer, index) { data['composer' + index] = composer; });
    tags.forEach(function(tag, index) { data['tag' + index] = tag; });

    fetch('../api/advanced-search-get-movies.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams(data) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { showMovieSearchResults(data.data); } else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function showMovieSearchResults(data)
{
    let movies = JSON.parse(data);

    if (movies.length === 0) { document.getElementById('movie-search-results').innerHTML = ''; set_user_msg('Aucun film trouvé', 'info'); return; }

    let table = document.createElement('table');
    table.classList.add('table', 'table-striped', 'table-hover');
    table.innerHTML = '<thead><tr><th scope="col">Title</th><th scope="col">Release date</th><th scope="col">Duration</th><th scope="col">Rating</th><th scope="col">Note</th><th scope="col">Seen</th><th scope="col">Synopsis</th></tr></thead><tbody>';
    movies.forEach(function(movieId)
    {
        fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'movies', 'conditionLength': '1', 'attribute0': 'id', 'value0': movieId }) })
            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
            .then(data => { if (data.success)
            {
                let movie = JSON.parse(data.data)[0];
                table.innerHTML += '<tr><td id="' + movie.id + '">' + movie.title + '</td><td>' + movie.release_date + '</td><td>' + movie.time_duration + '</td><td>' + movie.rating + '</td><td>' + movie.note + '</td><td>' + movie.vu + '</td><td>' + movie.synopsis + '</td></tr>';
            }
            else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
            .catch(error => { console.error(error); });
    });
    table.innerHTML += '</tbody>';
    document.getElementById('movie-search-results').innerHTML = '';
    document.getElementById('person-search-results').innerHTML = '';
    document.getElementById('movie-search-results').appendChild(table);
}