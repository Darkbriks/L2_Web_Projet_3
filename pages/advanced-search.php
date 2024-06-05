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
    <script>
        document.addEventListener('DOMContentLoaded', function() { document.getElementById('validate-search').addEventListener('click', searchMovies); });
    </script>

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

                    <div class="mb-3">
                        <div class="input-group">
                            <label class="input-group-text" for="filter-movie-tag">Tag</label>
                            <select class="form-select" id="filter-movie-tag">
                                <option value="null">Choose an operator</option>
                                <option value="AND">AND</option>
                                <option value="OR">OR</option>
                            </select>
                        </div>
                        <div id='category'>
                            <?php try
                            {
                                $tagDB = new mdb\TagDB(); $categories = $tagDB->getTags();
                                foreach ($categories as $category) {?>
                                    <div class="form-check">
                                        <input class="form-check-input" type='checkbox' name='category[]' id='category_<?php echo $category->getId() ?>' value='<?php echo $category->getId() ?>'>
                                        <label class="form-check-label" for='category_<?php echo $category->getId() ?>'><?php echo $category->getName() ?></label>
                                    </div>
                                <?php }
                            }
                            catch (Exception $e) { echo $e->getMessage(); } ?>
                        </div>
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

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);
