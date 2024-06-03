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
    fetch('../ajax/get-movies-by-tag.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'tagId': tagId }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { renderMovies(JSON.parse(data.data)); } else { set_user_msg(data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function renderMovies(movies)
{
    const carrousel = document.querySelector('.carrousel');
    carrousel.innerHTML = '';

    const moviesPerSlide = Math.max(Math.floor((window.innerWidth * 0.95) / (window.innerHeight * 0.35) - 1), 1);
    let slideIndex = 0;

    for (let i = 0; i < movies.length; i += moviesPerSlide)
    {
        const slide = document.createElement('div');
        slide.classList.add('carrousel-slide');
        if (slideIndex !== 0) slide.style.display = 'none';

        // Get the movies for the current slide.
        // Slice is a method that returns a shallow copy of a portion of an array into a new array object.
        const slideMovies = movies.slice(i, i + moviesPerSlide);
        slideMovies.forEach(movie =>
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