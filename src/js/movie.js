document.addEventListener('DOMContentLoaded', function() {



    const movies = [
        { title: 'Film 1', release_date: '1977', synopsis: 'Ceci est un synopsis.', vu: true, poster_link: '../assets/newHope.jpeg', producer: 'Réalisateur 1', producer_id: 1, actors: ['Acteur 1', 'Acteur 2'], tags: ['Action', 'Drame'] },
        { title: 'Film 2', release_date: '1983', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/returnOfJedi.jpeg', producer: 'Réalisateur 5', producer_id: 5, actors: ['Acteur 3', 'Acteur 4'], tags: ['Comédie'] },
        { title: 'Film 3', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 7', producer_id: 7, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 4', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 1', producer_id: 1, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 5', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 6', producer_id: 6, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 6', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 2', producer_id: 2, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 7', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 3', producer_id: 3, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 8', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 8', producer_id: 8, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] },
        { title: 'Film 9', release_date: '1980', synopsis: 'Ceci est un synopsis.', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 4', producer_id: 4, actors: ['Acteur 5', 'Acteur 6'], tags: ['Drame'] }
    ];
    function renderMovies(movies) {
        const container = document.getElementById('movies-container');
        container.innerHTML = '';

        movies.forEach(movie => {
            const movieElement = document.createElement('div');
            movieElement.classList.add('movie-card');
            movieElement.innerHTML = `
                <div class='movie-poster'>
                    <img src='${movie.poster_link}' alt='Affiche de ${movie.title}'>
                </div>
                <div class='movie-details'>
                    <h3>${movie.title} (${movie.release_date})</h3>
                    <p class='movie-synopsis'>${movie.synopsis}</p>
                    <p class='movie-producer'><strong>Réalisateur :</strong> <a href="../html/person.html?id=${movie.producer_id}">${movie.producer}</a></p>
                    <p class='movie-actors'><strong>Acteurs :</strong> <a href="../html/actors.html" id=${movie.actors_id}>${movie.actors.join(', ')}</a></p>
                    <p class='movie-tags'><strong>Tags :</strong> ${movie.tags.join(', ')}</p>
                    <p class='movie-status'><strong>Status :</strong> ${movie.vu ? 'Vu' : 'Non vu'}</p>
                </div>
            `;
            container.appendChild(movieElement);

            const posterImg = movieElement.querySelector('.movie-poster img');
            const details = movieElement.querySelector('.movie-details');

            posterImg.addEventListener('click', () => {
                    posterImg.style.transform = 'rotateZ(360deg)';
                    posterImg.style.transition = 'transform 0.3s';
                    details.style.display = 'flex';
            });
            details.addEventListener('click', () => {
                    posterImg.style.transform = 'rotateZ(-360deg)';
                    posterImg.style.transition = 'transform 0.3s';
                    details.style.display = 'none';

            });
        });
    }

 function filterMoviesByTag(tag) {
        if (tag === 'All') {
            renderMovies(movies);
        } else {
            const filteredMovies = movies.filter(movie => movie.tags.includes(tag));
            renderMovies(filteredMovies);
        }
    }
    document.querySelectorAll('.tag').forEach(tagElement => {
        tagElement.addEventListener('click', () => {
            filterMoviesByTag(tagElement.getAttribute('data-tag'));
        });
    });
    renderMovies(movies);
});

