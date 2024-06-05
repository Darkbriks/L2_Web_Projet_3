function updateOptionList(type, value)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/get-data.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('table=person&conditionLength=2&attribute0=first_name&attribute1=last_name&value0=' + value + '&value1=' + value + '&and=false&limit=5&useLike=true');
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === 4 && xhr.status === 200)
        {
            let response = JSON.parse(xhr.responseText);
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
                    option.addEventListener('click', addPersonToList.bind(null, type, person.id, person.first_name + ' ' + person.last_name));
                    personList.appendChild(option);
                });
            }
            else { set_user_msg(response.error, 'danger'); }
        }
    }
}

function clearOptionList(type) { let personList = document.getElementById(type + 'DatalistOptions'); personList.innerHTML = ''; }

function addPersonToList(type, id, name)
{
    let personList = document.getElementById(type + 'List');
    personList.querySelectorAll('.input').forEach(function(person)
    {
        if (person.value === id) { console.log('Personne déjà ajoutée'); return; }
        // TODO: Fix this
    });

    let person = document.createElement('div');
    person.classList.add('input-group', 'mb-3');

    person.innerHTML = '<input class="form-control" type="text" value="' + name + '" readonly>' +
        '<button type="button" class="btn-close remove-btn" aria-label="Close" onclick="removePersonFromList(this)"></button>' +
        '<input class="person-id-value" type="hidden" name="' + type + '[]" value="' + id + '">';

    personList.appendChild(person);
    clearOptionList(type);
    document.getElementById(type + 'DataList').value = '';
}

function removePersonFromList(button) { button.parentElement.remove(); }