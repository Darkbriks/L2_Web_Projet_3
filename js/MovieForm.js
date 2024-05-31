document.addEventListener('DOMContentLoaded', function()
{
    document.getElementById('posters').addEventListener('change', function()
    {
        let file = this.files[0];
        let reader = new FileReader();
        reader.onload = function(e)
        {
            document.getElementById('posters-preview').innerHTML = '<img src=\"' + e.target.result + '\" alt=\"' + file.name + '\">';
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('addCategory').addEventListener('click', function()
    {
        let newCategory = document.getElementById('newCategory').value.trim();
        if (newCategory)
        {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../ajax/addTag.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('tag=' + newCategory);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200)
                {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success)
                    {
                        // Ajouter le tag à la liste des catégories
                        let newCategory = document.createElement('div');
                        newCategory.innerHTML = '<input type=\"checkbox\" name=\"category[]\" id=\"category_' + response.id + '\" value=\"' + response.id + '\"><label for=\"category_' + response.id + '\">' + response.name + '</label>';
                        document.getElementById("categories").appendChild(newCategory);
                    }
                }
            };
        }
    });

    document.getElementById('AddDirectorButton').addEventListener('click', function()
    {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/movieFormAddPerson.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('person=' + document.getElementById('directorsDataList').value);
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4 && xhr.status === 200)
            {
                let response = JSON.parse(xhr.responseText);
                if (response.success)
                {
                    let data = JSON.parse(response.data);
                    document.querySelector('.directorsList').innerHTML += '' +
                        '<div><input type=\"hidden\" name=\"directors[]\" value=\"' + data.id + '\" id=\"' + data.full_name + '\">' +
                        '<label>' + data.full_name + '</label><button type=\"button\" onclick=\"this.parentElement.remove();\">Remove</button></div>';
                }
                else { console.log('Erreur:', response.error); }
            }
        }
    });
});
// TODO 1: Add form validation