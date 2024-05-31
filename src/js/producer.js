document.addEventListener('DOMContentLoaded', function() {
    const producers = [
        { id: 1, name: 'Réalisateur 1', birth_date: '1940-05-14', death_date: '', image: '../assets/harrisonFord.jpeg', movies: ['Film 1', 'Film 4'] },
        { id: 2, name: 'Réalisateur 2', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 6'] },
        { id: 3, name: 'Réalisateur 3', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 7'] },
        { id: 4, name: 'Réalisateur 4', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 9'] },
        { id: 5, name: 'Réalisateur 5', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 2'] },
        { id: 6, name: 'Réalisateur 6', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 5'] },
        { id: 7, name: 'Réalisateur 7', birth_date: '1930-08-20', death_date: '2005-11-12', image: '../assets/harrisonFord.jpeg', movies: ['Film 3'] },
        { id: 8, name: 'Réalisateur 8', birth_date: '1950-12-05', death_date: '', image: '../assets/harrisonFord.jpeg', movies: ['Film 8'] }
    ];

    const urlParams = new URLSearchParams(window.location.search);
    const producerId = parseInt(urlParams.get('id'));
    const producer = producers.find(p => p.id === producerId);

    const container = document.getElementById('producers-container');
    container.innerHTML = '';

    if (producer) {
        const producerElement = document.createElement('div');
        producerElement.classList.add('producer-details');
        producerElement.innerHTML = `
            <div class='producer-image'>
                <img src='${producer.image}' alt='image de ${producer.name}'>
            </div>
            <div class='producer-info'>
                <h2>${producer.name}</h2>
                <p><strong>Date de naissance :</strong> ${producer.birth_date}</p>
                <p><strong>Date de décès :</strong> ${producer.death_date ? producer.death_date : 'Still Alive'}</p>
                <p><strong>Films réalisés :</strong> ${producer.movies.join(', ')}</p>
            </div>
        `;
        container.appendChild(producerElement);
    } else {

        renderProducers(producers);
    }

    function renderProducers(producers) {
        producers.forEach(producer => {
            const producerCard = document.createElement('div');
            producerCard.classList.add('producer-card');
            producerCard.innerHTML = `
                <div class='producer-image'>
                    <img src='${producer.image}' alt='image de ${producer.name}'>
                </div>
                <div class='producer-name'>
                    <h3><a href="person.html?id=${producer.id}">${producer.name}</a></h3>
                </div>
            `;
            container.appendChild(producerCard);

            producerCard.querySelector('.producer-image img').addEventListener('click', () => {
                window.location.href = `person.html?id=${producer.id}`;
            });

            producerCard.querySelector('.producer-name a').addEventListener('click', () => {
                window.location.href = `person.html?id=${producer.id}`;
            });
        });
    }
});
