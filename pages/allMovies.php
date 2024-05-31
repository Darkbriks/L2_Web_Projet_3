<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();
?>

<?php ob_start(); ?>

    <script src="../js/allMovies.js"></script>
    <h1>MOVIES</h1>
    <div class="tags-menu" id="tags-menu">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by tag
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item tag" href="#" data-tag="-1">All</a></li>
                <?php
                $tagBD = new mdb\TagBD();
                $tags = $tagBD->getTags();
                foreach ($tags as $tag) { echo $tag->getHtml_li(); }
                ?>
            </ul>
        </div>
    </div>

    <div class = "slider-container">
        <div class="movies-container" id="movies-container"></div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);