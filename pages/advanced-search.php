<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

?>

<?php ob_start(); ?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movie-modal">Movie</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#person-modal">Person</button>

    <div id="movie-search-results"></div>

    <div class="modal fade" id="movie-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $GLOBALS['advanced-search-movie-modal-title']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-title', ['LIKE' => 'Like', 'NOT LIKE' => 'Not like']);
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-release', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-duration', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-rating', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-note', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-synopsis', ['LIKE' => 'Like', 'NOT LIKE' => 'Not like']);
                    ?>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="filter-movie-seen">Vu</label>
                        <select class="form-select" id="filter-movie-seen">
                            <option value="null">Choose an operator</option>
                            <option value="1">True</option>
                            <option value="0">False</option>
                            <option value="-1">Both</option>
                        </select>
                    </div>

                    <?php echo mdb\form\GenerateFormInput::generateAdvancedSearchPersonFields(); ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="validate-search">Search</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="person-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    .
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            //document.getElementById('addCategory').addEventListener('click', addTag);

            document.getElementById('validate-search').addEventListener('click', searchMovies);
        });

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
                    else { showMovieFormMsg(response.error, 'danger'); }
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

        function searchMovies()
        {
            let title = document.getElementById('filter-movie-title').value;
            let titleOperator = document.getElementById('operator-movie-title').value;
            let release = document.getElementById('filter-movie-release').value;
            let releaseOperator = document.getElementById('operator-movie-release').value;
            let duration = document.getElementById('filter-movie-duration').value;
            let durationOperator = document.getElementById('operator-movie-duration').value;
            let rating = document.getElementById('filter-movie-rating').value;
            let ratingOperator = document.getElementById('operator-movie-rating').value;
            let note = document.getElementById('filter-movie-note').value;
            let noteOperator = document.getElementById('operator-movie-note').value;
            let seen = document.getElementById('filter-movie-seen').value;
            let synopsis = document.getElementById('filter-movie-synopsis').value;
            let synopsisOperator = document.getElementById('operator-movie-synopsis').value;

            let directors = [];
            document.getElementById('directorList').querySelectorAll('.person-id-value').forEach(function(director) { directors.push(director.value); });
            let directorOperator = document.getElementById('operator-director').value;

            let actors = [];
            document.getElementById('actorList').querySelectorAll('.person-id-value').forEach(function(actor) { actors.push(actor.value); });
            let actorOperator = document.getElementById('operator-actor').value;

            let composers = [];
            document.getElementById('composerList').querySelectorAll('.person-id-value').forEach(function(composer) { composers.push(composer.value); });
            let composerOperator = document.getElementById('operator-composer').value;

            let data = {
                'title': title,
                'titleOperator': titleOperator,
                'release': release,
                'releaseOperator': releaseOperator,
                'duration': duration,
                'durationOperator': durationOperator,
                'rating': rating,
                'ratingOperator': ratingOperator,
                'note': note,
                'noteOperator': noteOperator,
                'seen': seen,
                'synopsis': synopsis,
                'synopsisOperator': synopsisOperator,
                'nbDirectors': directors.length,
                'directorsOperator': directorOperator,
                'nbActors': actors.length,
                'actorsOperator': actorOperator,
                'nbComposers': composers.length,
                'composersOperator': composerOperator,
            };

            directors.forEach(function(director, index) { data['director' + index] = director; });
            actors.forEach(function(actor, index) { data['actor' + index] = actor; });
            composers.forEach(function(composer, index) { data['composer' + index] = composer; });

            fetch('../api/advanced-search-get-movies.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams(data) })
                .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                .then(data => { if (data.success) { showMovieSearchResults(data.data); } else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
                .catch(error => { console.error(error); });
        }

        function showMovieSearchResults(data)
        {
            let movies = JSON.parse(data);

            if (movies.length === 0) { document.getElementById('movie-search-results').innerHTML = ''; set_user_msg('Aucun film trouvé', 'info'); return; }

            let table = document.createElement('table');
            table.classList.add('table', 'table-striped', 'table-hover');
            table.innerHTML = '<thead><tr><th scope="col">Title</th><th scope="col">Release date</th><th scope="col">Duration</th><th scope="col">Rating</th><th scope="col">Note</th><th scope="col">Seen</th><th scope="col">Synopsis</th></tr></thead><tbody>';
            movies.forEach(function(movieId)
            {
                fetch('../api/get-data.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'table': 'movies', 'conditionLength': 1, 'attribute0': 'id', 'value0': movieId }) })
                    .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                    .then(data => { if (data.success)
                    {
                        let movie = JSON.parse(data.data)[0];
                        table.innerHTML += '<tr><td>' + movie.title + '</td><td>' + movie.release_date + '</td><td>' + movie.time_duration + '</td><td>' + movie.rating + '</td><td>' + movie.note + '</td><td>' + movie.vu + '</td><td>' + movie.synopsis + '</td></tr>';
                    }
                    else { set_user_msg('Erreur: ' + data.error, 'danger'); } })
                    .catch(error => { console.error(error); });
            });
            table.innerHTML += '</tbody>';
            document.getElementById('movie-search-results').innerHTML = '';
            document.getElementById('movie-search-results').appendChild(table);
        }
    </script>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
