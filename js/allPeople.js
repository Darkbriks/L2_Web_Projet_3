document.addEventListener('DOMContentLoaded', function()
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../ajax/getAllPeoples.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            let response = JSON.parse(xhr.responseText);
            if (response.success) { renderPeople(JSON.parse(response.data)); }
            else { console.error('Erreur:', response.error); }
        }
    };
});

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
            "<img src='" + people.image + "' alt='image de " + people.full_name + "'>" +
        "</div>" +
        "<div class='people-name'>" +
            "<h3>" + people.full_name + "</h3>" +
        "</div>";


        container.appendChild(peopleCard);

        peopleCard.addEventListener('click', () =>
        {
            window.location.href = `person.php?id=${people.id}`;
        });
    });
}