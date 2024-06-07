document.addEventListener('DOMContentLoaded', function()
{
    // TODO: Vérifier si il ne serait pas mieux de séparer les fonctions de allMovies du reste

    const favorites = document.getElementById('favorites-list');
    const randomHome = document.getElementById('home-list');
    if (randomHome) {
        randomMovies()
    }
    else  if (favorites) {
        favoritesMovies()
    }
    else{
        document.querySelectorAll('.tag').forEach(tagElement => {
            tagElement.addEventListener('click', () => {
                filterMoviesByTag(tagElement.getAttribute('data-tag'));
            });
        });
        filterMoviesByTag(-1);

    }

    const randomHomeButton = document.getElementById('random-home');
    if (randomHomeButton) {
        randomHomeButton.addEventListener('click', function() {
            randomMovies()
        });
    }
});

function randomMovies()
{
    fetch('../api/get-random-movies.php')
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { const movies = JSON.parse(data.data); renderMovies(movies, true); } else { set_user_msg(data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function favoritesMovies()
{
    fetch('../api/get-favorites_movies.php')
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { const movies = JSON.parse(data.data); renderMovies(movies); } else { set_user_msg(data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function filterMoviesByTag(tagId)
{
    fetch('../api/get-movies-by-tag.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'tagId': tagId }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { renderMovies(JSON.parse(data.data)); } else { set_user_msg(data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function renderMovies(movies, random = null )
{
    const carrousel = document.querySelector('.carrousel');
    carrousel.innerHTML = '';
    const moviesPerSlide = Math.max(Math.floor((window.innerWidth * 0.95) / (window.innerHeight * 0.35) - 1), 1);
    let slideIndex = 0;

    let limite;
    if (random === null) {
        limite = movies.length;
    } else {
        limite = moviesPerSlide;
    }

    for (let i = 0; i < limite; i += moviesPerSlide)
    {
        const slide = document.createElement('div');
        slide.classList.add('carrousel-slide');
        if (slideIndex !== 0) slide.style.display = 'none';

        // Get the movies for the current slide.
        // Slice is a method that returns a shallow copy of a portion of an array into a new array object.
        const slideMovies = movies.slice(i, i + moviesPerSlide);
        slideMovies.forEach(movie =>
        {
            let directors = JSON.parse(movie.directors);
            let actors = JSON.parse(movie.actors);
            let composers = JSON.parse(movie.composers);

            const movieElement = document.createElement('div');
            movieElement.classList.add('movie-card');
            let html =
                "<div class='movie-poster'>" +
                    "<img src='" + movie.image_path + "' alt='Affiche de " + movie.title + "'>" +
                "</div>" +
                "<div class='movie-details'>" +
                    "<h3 class='movie-title' id='" + movie.id + "' style='cursor: pointer'>" + movie.title + " (" + movie.release_date + ")</h3>" +
                    "<p class='movie-synopsis'>" + movie.synopsis + "</p>";

            html += "<p class='movie-director'><strong>Réalisateur :</strong> ";
            for (let i = 0; i < directors.length; i++) { html += "<a href='../pages/person.php?id=" + directors[i].id + "'>" + directors[i].full_name + "</a> "; }
            html += "</p><p class='movie-actor'><strong>Acteurs :</strong> ";
            for (let i = 0; i < actors.length; i++) { html += "<a href='../pages/person.php?id=" + actors[i].id + "'>" + actors[i].full_name + "</a> "; }
            html += "</p><p class='movie-composer'><strong>Compositeurs :</strong> ";
            for (let i = 0; i < composers.length; i++) { html += "<a href='../pages/person.php?id=" + composers[i].id + "'>" + composers[i].full_name + "</a> "; }

            html += "</p><p class='movie-tags'><strong>Tags :</strong> " + movie.tags.join(', ') + "</p>" +
                    "<p class='movie-status'><strong>Status :</strong> " + (movie.vu ? 'Vu' : 'Non vu') + "</p>" +
                "</div>";
            movieElement.innerHTML = html;

            slide.appendChild(movieElement);

            const title = movieElement.querySelector('.movie-title');
            const posterImg = movieElement.querySelector('.movie-poster img');
            const details = movieElement.querySelector('.movie-details');

            title.addEventListener('click', () => { window.location.href = 'movie.php?id=' + title.id; });

            posterImg.addEventListener('click', () =>
            {
                posterImg.style.transform = 'rotateZ(360deg)';
                posterImg.style.transition = 'transform 0.5s';
                details.style.display = 'flex';
            });

            details.addEventListener('click', () =>
            {
                posterImg.style.transform = 'rotateZ(0deg)';
                posterImg.style.transition = 'transform 0.5s';
                details.style.display = 'none';
            });
        });

        carrousel.appendChild(slide);
        slideIndex++;
    }
    if(random === null && movies.length > moviesPerSlide ){
        // Create navigation buttons
        const prevButton = document.createElement('button');
        prevButton.classList.add('carousel-control-prev-icon');
        prevButton.classList.add('carrousel-nav');
        prevButton.addEventListener('click', () => showSlide(-1));
        carrousel.appendChild(prevButton);

        const nextButton = document.createElement('button');
        nextButton.classList.add('carousel-control-next-icon');
        nextButton.classList.add('carrousel-nav');
        nextButton.addEventListener('click', () => showSlide(1));
        carrousel.appendChild(nextButton);
    }
}

function showSlide(direction)
{
    const slides = document.querySelectorAll('.carrousel-slide');
    let slideIndex = 0;

    for (let i = 0; i < slides.length; i++) { if (slides[i].style.display !== 'none') { slideIndex = i; break; } }

    slides[slideIndex].style.display = 'none';
    slideIndex += direction;

    if (slideIndex < 0) slideIndex = slides.length - 1;
    if (slideIndex >= slides.length) slideIndex = 0;

    slides[slideIndex].style.display = 'flex';
}