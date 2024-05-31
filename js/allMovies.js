document.addEventListener('DOMContentLoaded', function()
{
    document.querySelectorAll('.tag').forEach(tagElement =>
    {
        tagElement.addEventListener('click', () =>
        {
            filterMoviesByTag(tagElement.getAttribute('data-tag'));
        });
    });
    filterMoviesByTag(-1)
});

function filterMoviesByTag(tagId)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../ajax/getMoviesByTag.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('tagId=' + tagId);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            let response = JSON.parse(xhr.responseText);
            if (response.success) { renderMovies(JSON.parse(response.data)); }
            else { console.error('Erreur:', response.error); }
        }
    };
}

function renderMovies(movies)
{
    const container = document.getElementById('movies-container');
    container.innerHTML = '';

    movies.forEach(movie =>
    {
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie-card');
        movieElement.innerHTML =
        "<div class='movie-poster'>" +
            "<img src='" + movie.image_path + "' alt='Affiche de " + movie.title + "'>" +
        "</div>" +
        "<div class='movie-details'>" +
            "<h3 class='movie-title' id='" + movie.id + "' style='cursor: pointer'>" + movie.title + " (" + movie.release_date + ")</h3>" +
            "<p class='movie-synopsis'>" + movie.synopsis + "</p>" +
            "<p class='movie-producer'><strong>Réalisateur :</strong> <a href='../html/person.html?id=" + movie.producer_id + "'>" + movie.producer + "</a></p>" +
            "<p class='movie-actors'><strong>Acteurs :</strong> <a href='../html/actors.html' id=" + movie.actors_id + ">" + movie.actors.join(', ') + "</a></p>" +
            "<p class='movie-tags'><strong>Tags :</strong> " + movie.tags.join(', ') + "</p>" +
            "<p class='movie-status'><strong>Status :</strong> " + (movie.vu ? 'Vu' : 'Non vu') + "</p>" +
        "</div>";

        container.appendChild(movieElement);

        const title = movieElement.querySelector('.movie-title');
        const posterImg = movieElement.querySelector('.movie-poster img');
        const details = movieElement.querySelector('.movie-details');

        title.addEventListener('click', () =>
        {
            window.location.href = 'movie.php?id=' + title.id;
        });

        posterImg.addEventListener('click', () =>
        {
            posterImg.style.transform = 'rotateZ(360deg)';
            posterImg.style.transition = 'transform 0.3s';
            details.style.display = 'flex';
        });

        details.addEventListener('click', () =>
        {
            posterImg.style.transform = 'rotateZ(-360deg)';
            posterImg.style.transition = 'transform 0.3s';
            details.style.display = 'none';
        });
    });
}