function searchPerson()
{
    let first_name = document.getElementById('filter-person-first-name').value;
    let first_nameOperator = document.getElementById('operator-person-first-name').value;
    let last_name = document.getElementById('filter-person-last-name').value;
    let last_nameOperator = document.getElementById('operator-person-last-name').value;
    let birthdate = document.getElementById('filter-person-birth-date').value;
    let birthdateOperator = document.getElementById('operator-person-birth-date').value;
    let deathdate = document.getElementById('filter-person-death-date').value;
    let deathdateOperator = document.getElementById('operator-person-death-date').value;

    let tags = [];
    document.getElementById('category').querySelectorAll('input[type="checkbox"]').forEach(function(tag) { if (tag.checked) { tags.push(tag.value); } });
    let tagsOperator = document.getElementById('operator-person-tag').value;

    let othersPerson = [];
    document.getElementById('other-personList').querySelectorAll('.person-id-value').forEach(function(person) { othersPerson.push(person.value); });
    let othersPersonOperator = document.getElementById('operator-other-person').value;

    let data = {
        'first_name': first_name,
        'first_nameOperator': first_nameOperator,
        'last_name': last_name,
        'last_nameOperator': last_nameOperator,
        'birthdate': birthdate,
        'birthdateOperator': birthdateOperator,
        'deathdate': deathdate,
        'deathdateOperator': deathdateOperator,
        'othersPersonOperator': othersPersonOperator,
        'nbOthersPerson': othersPerson.length,
        'tagsOperator': tagsOperator,
        'nbTags': tags.length
    };

    othersPerson.forEach(function(person, index) { data['otherPerson' + index] = person; });
    tags.forEach(function(tag, index) { data['tag' + index] = tag; });

    fetch('../api/advanced-search-get-person.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams(data) })
        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
        .then(data => { if (data.success) { showPersonSearchResults(data.data); } else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
        .catch(error => { set_user_msg(error, 'danger'); });
}

function showPersonSearchResults(data)
{
    let persons = JSON.parse(data);

    if (persons.length === 0) { set_user_msg('Aucun résultat trouvé', 'info'); return; }

    let table = document.createElement('table');
    table.classList.add('table', 'table-striped', 'table-hover');
    table.innerHTML = '<thead><tr><th scope="col">Nom</th><th scope="col">Prénom</th><th scope="col">Date de naissance</th><th scope="col">Date de décès</th></tr></thead><tbody>';
    persons.forEach(function(personId)
    {
        fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'person', 'conditionLength': '1', 'attribute0': 'id', 'value0': personId }) })
            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
            .then(data => { if (data.success)
            {
                console.log(data.data);
                let person = JSON.parse(data.data)[0];
                table.innerHTML += '<tr><td>' + person.last_name + '</td><td>' + person.first_name + '</td><td>' + person.birth_date + '</td><td>' + person.death_date + '</td></tr>';
            }
            else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
            .catch(error => { console.error(error); });
    });
    table.innerHTML += '</tbody>';
    document.getElementById('person-search-results').innerHTML = '';
    document.getElementById('person-search-results').appendChild(table);
}