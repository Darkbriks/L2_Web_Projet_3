document.addEventListener('DOMContentLoaded', function() { getPeople(); });

function getPeople()
{
    fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'person', 'conditionLength' : '0', 'limit' : '100' }) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { renderPeople(JSON.parse(data.data)); } else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
        .catch(error => { console.error(error); });
}

function renderPeople(peoples)
{
    const container = document.getElementById('peoples-container');
    container.innerHTML = '';

    peoples.forEach(people =>
    {
        const peopleCard = document.createElement('div');
        peopleCard.classList.add('people-card');
        peopleCard.style.cursor = 'pointer';
        peopleCard.innerHTML =
        "<div class='people-image'>" +
            "<img src='" + people.image_path + "' alt='image de " + people.full_name + "'>" +
        "</div>" +
        "<div class='people-name'>" +
            "<h3>" + people.full_name + "</h3>" +
        "</div>";

        container.appendChild(peopleCard);
        peopleCard.addEventListener('click', () => { window.location.href = `person.php?id=${people.id}`; });
    });
}