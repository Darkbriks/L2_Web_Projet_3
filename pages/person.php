<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

session_start();
$lang = $_SESSION['language'] ?? 'EN';
require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';

ob_start();

try {
    if (!isset($_GET['id'])) {
        throw new Exception($GLOBALS['person-error-1'], 1);
    }
    $id = htmlspecialchars($_GET['id']);
    $personDB = new mdb\PersonDB();
    $persons = $personDB->getPersonById($id);
    if (count($persons) == 0) {
        throw new Exception($GLOBALS['person-error-2'] . $id, 2);
    }
    echo $persons[0]->getHtml($lang);

    $actorMovies = $personDB->getMoviesOfPerson($id, 1);
    $directorMovies = $personDB->getMoviesOfPerson($id, 2);
    $composerMovies = $personDB->getMoviesOfPerson($id, 3);

    function displayMovies($movies, $role) {
        if (count($movies) > 0) {
            echo "<h3>{$role}</h3>";
            echo '<div class="movie-card-list">';
            foreach ($movies as $movie) {
                echo '<div class="movie-card">';
                echo '<a href="movie.php?id=' . $movie->id . '">';
                echo '<img src="' . $GLOBALS['POSTER_DIR'] . $movie->image_path . '" alt="' . $movie->title . '">';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>';
        }
    }

    displayMovies($actorMovies, $GLOBALS['movie-actors']);
    displayMovies($directorMovies, $GLOBALS['movie-directors']);
    displayMovies($composerMovies, $GLOBALS['movie-composers']);
} catch (Exception $e) {
    ?><script>
        document.addEventListener('DOMContentLoaded', function() {
            set_user_msg("<?php echo $e->getMessage() . " Code: " . $e->getCode(); ?>", "danger");
        });
    </script><?php
}

$content = ob_get_clean();
Template::render($content);
?>
