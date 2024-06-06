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

    <script src="../js/form-utilities.js"></script>
    <script src="../js/advanced-search-movies.js"></script>
    <script src="../js/advanced-search-person.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            document.getElementById('validate-movie-search').addEventListener('click', searchMovies);
            document.getElementById('validate-person-search').addEventListener('click', searchPerson);
        });
    </script>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movie-modal">Movie</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#person-modal">Person</button>

    <div id="movie-search-results"></div>
    <div id="person-search-results"></div>

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
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-seen', ['1' => 'Seen', '0' => 'Not seen', '-1' => 'All'], false);
                    ?>

                    <div class="mb-3">
                        <?php
                            echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('movie-tag', ['AND' => 'AND', 'OR' => 'OR'], false);
                            echo mdb\form\GenerateFormInput::generateCategoryList();
                        ?>
                    </div>

                    <?php echo mdb\form\GenerateFormInput::generateAdvancedSearchPersonFields(); ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="validate-movie-search">Search</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="person-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $GLOBALS['advanced-search-movie-modal-title']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                    echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('person-first-name', ['LIKE' => 'Like', 'NOT LIKE' => 'Not like']);
                    echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('person-last-name', ['LIKE' => 'Like', 'NOT LIKE' => 'Not like']);
                    echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('person-birth-date', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                    echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('person-death-date', ['=' => 'Equal', '!=' => 'Not equal', '>' => 'Greater than', '<' => 'Less than']);
                    echo mdb\form\GenerateFormInput::generateAdvancedSearchPersonInput('other-person');
                    ?>

                    <div class="mb-3">
                        <?php
                        echo mdb\form\GenerateFormInput::generateAdvancedSearchInput('person-tag', ['AND' => 'AND', 'OR' => 'OR'], false);
                        echo mdb\form\GenerateFormInput::generateCategoryList();
                        ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="validate-person-search">Search</button>
                </div>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
