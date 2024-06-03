<?php
require_once "../config.php";
require_once "../DB_CREDENTIALS.php";
require_once $GLOBALS['PDO_WRAPPER'];
require_once $GLOBALS['LOCALIZATION_DIR'] . $GLOBALS['CURRENT_LANGUAGE'] . '.php';

require ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Autoloader.php";
Autoloader::register();

// Vérifie si les données ont été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crée une instance de la classe ActorForm
    $actorForm = new mdb\ActorForm();

    // Appelle la méthode createActor avec les données du formulaire
    try {
        $img_file = $_FILES['image_path'] ?? null;
        $actorForm->createActor($_POST, $img_file);
        // Envoyer une réponse HTTP 200 en cas de succès
        http_response_code(200);
        echo 'Acteur ajouté avec succès.';
    } catch (Exception $e) {
        // En cas d'erreur, envoyer une réponse HTTP 500
        http_response_code(500);
        echo 'Erreur lors de l\'ajout de l\'acteur : ' . $e->getMessage();
    }
} else {
    // Si la méthode HTTP n'est pas POST, renvoyer une erreur
    http_response_code(405);
    echo 'Méthode non autorisée.';
}
?>
