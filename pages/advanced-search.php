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

    <div class="modal fade" id="movie-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $GLOBALS['advanced-search-movie-modal-title']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="movie-filter">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="filter-movie-title">Title</label>
                            <select class="form-select" id="operator">
                                <option value="=">Equal</option>
                                <option value="!=">Not equal</option>
                                <option value="LIKE">Like</option>
                                <option value="NOT LIKE">Not like</option>
                            </select>
                            <input type="text" class="form-control" id="filter-movie-title">
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-release">Release date</label>
                                <select class="form-select" id="operator">
                                    <option value="=">Equal</option>
                                    <option value="!=">Not equal</option>
                                    <option value=">">Greater than</option>
                                    <option value="<">Less than</option>
                                </select>
                                <input type="date" class="form-control" id="filter-movie-release">
                            </div>
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-duration">Time duration</label>
                                <select class="form-select" id="operator">
                                    <option value="=">Equal</option>
                                    <option value="!=">Not equal</option>
                                    <option value=">">Greater than</option>
                                    <option value="<">Less than</option>
                                </select>
                                <input type="number" class="form-control" id="filter-movie-duration">
                            </div>
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-rating">Rating</label>
                                <select class="form-select" id="operator">
                                    <option value="=">Equal</option>
                                    <option value="!=">Not equal</option>
                                    <option value=">">Greater than</option>
                                    <option value="<">Less than</option>
                                </select>
                                <input type="number" class="form-control" id="filter-movie-rating">
                            </div>
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-note">Note</label>
                                <select class="form-select" id="operator">
                                    <option value="=">Equal</option>
                                    <option value="!=">Not equal</option>
                                    <option value=">">Greater than</option>
                                    <option value="<">Less than</option>
                                </select>
                                <input type="number" class="form-control" id="filter-movie-note">
                            </div>
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-seen">Vu</label>
                                <select class="form-select" id="filter-movie-seen">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                    <option value="null">Both</option>
                                </select>
                            </div>
                        </div>

                        <div id="movie-filter">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="filter-movie-synopsis">Synopsis</label>
                                <select class="form-select" id="operator">
                                    <option value="LIKE">Like</option>
                                    <option value="NOT LIKE">Not like</option>
                                </select>
                                <input type="text" class="form-control" id="filter-movie-synopsis">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
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
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
        });

        const movie_filters = [
            {name: 'title', value: 'string', operators: ['=', '!=', 'LIKE', 'NOT LIKE']},
            {name: 'release_date', value: 'date', operators: ['=', '!=', '>', '>=', '<', '<=']},
            {name: 'time_duration', value: 'int', operators: ['=', '!=', '>', '>=', '<', '<=']},
            {name: 'rating', value: 'int', operators: ['=', '!=', '>', '>=', '<', '<=']},
            {name: 'note', value: 'int', operators: ['=', '!=', '>', '>=', '<', '<=']},
            {name: 'vu', value: 'bool', operators: ['=', '!=']}
            {name: 'synopsis', value: 'string', operators: ['LIKE', 'NOT LIKE']}
            {name: 'director', value: 'person', operators: ['=', '!=']}
            {name: 'actors', value: 'person', operators: ['=', '!=']}
            {name: 'composer', value: 'person', operators: ['=', '!=']}
            {name: 'tags', value: 'tag', operators: ['=', '!=']}
        ];
    </script>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
