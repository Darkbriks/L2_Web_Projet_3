document.addEventListener('DOMContentLoaded', function() {
    const movies = [
        {id: 1, title: 'Film 1', release_date: '1977', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: true, poster_link: '../assets/newHope.jpeg', producer: 'Réalisateur 1', producer_id: 1, actors: ['Acteur 1', 'Acteur 2'], actor_ids: [1, 2], tags: ['Action', 'Drame']},
        {id: 2, title: 'Film 2', release_date: '1983', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/returnOfJedi.jpeg', producer: 'Réalisateur 5', producer_id: 5, actors: ['Acteur 3', 'Acteur 4'], actor_ids: [3, 4], tags: ['Comédie']},
        {id: 4, title: 'Film 3', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 7', producer_id: 7, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 5, title: 'Film 4', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 1', producer_id: 1, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 6, title: 'Film 5', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 6', producer_id: 6, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 7, title: 'Film 6', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 2', producer_id: 2, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 8, title: 'Film 7', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 3', producer_id: 3, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 9, title: 'Film 8', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 8', producer_id: 8, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']},
        {id: 10, title: 'Film 9', release_date: '1980', synopsis: 'Ceci est un synopsis.', trilar : 'trilar here', vu: false, poster_link: '../assets/strikesBack.jpeg', producer: 'Réalisateur 4', producer_id: 4, actors: ['Acteur 5', 'Acteur 6'], actor_ids: [5, 6], tags: ['Drame']}
    ];

    function getMovieById(id) {
        return movies.find(movie => movie.id === id);
    }

    function renderMovieDetails(movie) {
        const container = document.getElementById('movie-details');
        container.innerHTML = '';

        const movieDetails = document.createElement('div');
        movieDetails.classList.add('m_details');

        movieDetails.innerHTML = `
        <div class='movie-poster'>
            <img src='${movie.poster_link}' alt='Affiche de ${movie.title}'>
        </div>
        <div class='movie-info'>
            <h3>${movie.title} (${movie.release_date})</h3>
            <p class='movie-synopsis'>${movie.synopsis}</p>
            <p class='movie-trilar'>${movie.trilar}</p>
            <p class='movie-producer'><strong>Réalisateur :</strong> <a href="person.html?id=${movie.producer_id}">${movie.producer}</a></p>
            <p class='movie-actors'><strong>Acteurs :</strong> ${movie.actors.map((actor, index) => `<a href="person.html?id=${movie.actor_ids[index]}">${actor}</a>`).join(', ')}</p>
            <p class='movie-tags'><strong>Tags :</strong> ${movie.tags.join(', ')}</p>
            <p class='movie-status'><strong>Status :</strong> ${movie.vu ? 'Vu' : 'Non vu'}</p>
        </div>
    `;
        container.appendChild(movieDetails);
    }


    const urlParams = new URLSearchParams(window.location.search);
    const movieId = parseInt(urlParams.get('id'));
    const movie = getMovieById(movieId);

    if (movie) {
        console.log("movie")
        renderMovieDetails(movie);
    } else {
        document.getElementById('movie-details').innerHTML = '<p>Movie not found.</p>';
    }

});


