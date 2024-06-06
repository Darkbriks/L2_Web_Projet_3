function updateOptionList(type, value, addRole = false)
{
    // TODO: Ajouter la possibilité de créer une personne si elle n'existe pas
    fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'table=person&conditionLength=2&attribute0=first_name&attribute1=last_name&value0=' + value + '&value1=' + value + '&and=false&limit=5&useLike=true' })
        .then(response => response.json())
        .then(response =>
        {
            if (response.success)
            {
                let personList = document.getElementById(type + 'DatalistOptions');
                personList.innerHTML = '';
                let data = JSON.parse(response.data);
                data.forEach(function(person)
                {
                    let option = document.createElement('button');
                    option.classList.add('list-group-item', 'list-group-item-action');
                    option.innerHTML = person.first_name + ' ' + person.last_name;
                    option.id = person.id;
                    option.addEventListener('click', addPersonToList.bind(null, type, person.id, person.first_name + ' ' + person.last_name, addRole));
                    personList.appendChild(option);
                });
            }
            else { set_user_msg(response.error, 'danger'); }
        });
}

function clearOptionList(type) { let personList = document.getElementById(type + 'DatalistOptions'); personList.innerHTML = ''; }

function addPersonToList(type, id, name, addRole = false)
{
    let personList = document.getElementById(type + 'List');
    let persons = document.getElementById(type + 'List').querySelectorAll('.person-id-value');
    for (let i = 0; i < persons.length; i++) { if (persons[i].value === id.toString()) { clearOptionList(type); document.getElementById(type + 'DataList').value = ''; return; } }

    let person = document.createElement('div');
    person.classList.add('input-group', 'mb-3');

    if (!addRole)
    {
        person.innerHTML = '<input class="form-control" type="text" value="' + name + '" readonly>' +
            '<button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removePersonFromList(this)"></button>' +
            '<input class="person-id-value" type="hidden" name="' + type + '[]" value="' + id + '">';
    }
    else
    {
        let role = document.createElement('input');
        role.classList.add('form-control');
        role.type = 'text';
        role.placeholder = 'Rôle';
        role.name = type + '_role[]';
        person.innerHTML = '<input class="form-control" type="text" value="' + name + '" readonly><input type="hidden" name="' + type + '[]" value="' + id + '">';
        person.appendChild(role);
        person.innerHTML += '<button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removePersonFromList(this)"></button>';
    }

    personList.appendChild(person);
    clearOptionList(type);
    document.getElementById(type + 'DataList').value = '';
}

function removePersonFromList(button) { button.parentElement.remove(); }