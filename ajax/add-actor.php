<?php

require_once 'path/to/ActorForm.php';

// Vérifie si les données ont été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crée une instance de la classe ActorForm
    $actorForm = new mdb\ActorForm();

    // Appelle la méthode createActor avec les données du formulaire
    try {
        $actorForm->createActor($_POST, $_FILES['image']);
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
