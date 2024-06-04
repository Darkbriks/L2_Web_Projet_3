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

    <script src="../js/allMovies.js"></script>
    <h1><?php echo $GLOBALS['all-movies-title']; ?></h1>
    <div class="tags-menu" id="tags-menu">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $GLOBALS['all-movies-filter-by-tag']; ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item tag" href="#" data-tag="-1">All</a></li>
                <?php
                try
                {
                    $tagBD = new mdb\TagDB();
                    $tags = $tagBD->getTags();
                    foreach ($tags as $tag) { echo $tag->getHtml_li(); }
                }
                catch (Exception $e) { ?><script> document.addEventListener('DOMContentLoaded', function() { set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger"); }); </script> <?php }
                ?>
            </ul>
        </div>
    </div>

    <div class="carrousel" id="movies-container"></div>

<?php $content = ob_get_clean(); ?>
<?php Template::render($content);