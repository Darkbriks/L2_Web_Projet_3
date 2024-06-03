<?php
////////// FR //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'Mes films';
$GLOBALS['template-light-theme'] = 'Thème clair';
$GLOBALS['template-dark-theme'] = 'Thème sombre';

// header.php
$GLOBALS['header-title'] = 'Accueil des films';
$GLOBALS['header-home'] = 'Accueil';
$GLOBALS['header-movies'] = 'Films';
$GLOBALS['header-peoples'] = 'Peoples';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-logout'] = 'Déconnexion';
$GLOBALS['header-theme'] = 'Thème';
$GLOBALS['header-language-dropdown-default'] = 'Choisir la langue';

// footer.php
$GLOBALS['footer-text'] = 'Sources des éléments ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Film ajouté avec succès';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Ajouter un film';
$GLOBALS['movie-form-add-movie-title'] = 'Titre';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Entrez le titre du film';
$GLOBALS['movie-form-add-movie-release-date'] = 'Date de sortie';
$GLOBALS['movie-form-add-movie-duration'] = 'Durée';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Entrez la durée du film';
$GLOBALS['movie-form-add-movie-poster'] = 'Affiche';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Supprimer';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Entrez le synopsis du film';
$GLOBALS['movie-form-add-movie-trailer'] = 'Bande-annonce';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Entrez la bande-annonce du film';
$GLOBALS['movie-form-add-movie-tags'] = 'Tags';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Nouveau tag';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Ajouter un tag';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Classification';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Entrez la classification du film';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Tout public';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'ans et plus';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Liste des réalisateurs';
$GLOBALS['movie-form-add-movie-add-director'] = 'Ajouter un réalisateur';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Liste des acteurs';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Ajouter un acteur';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Liste des compositeurs';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Ajouter un compositeur';
$GLOBALS['movie-form-add-movie-seen'] = 'Vu';
$GLOBALS['movie-form-add-movie-add'] = 'Ajouter';
$GLOBALS['movie-form-add-movie-cancel'] = 'Annuler';
$GLOBALS['movie-form-exception-adding'] = 'Erreur lors de l\'ajout du film dans la base de données';
$GLOBALS['movie-form-exception-upload'] = 'Erreur lors du téléchargement de l\'affiche';
$GLOBALS['movie-form-exception-title'] = 'Le titre du film est obligatoire et doit contenir entre 3 et 50 caractères';
$GLOBALS['movie-form-exception-release-date'] = 'La date de sortie doit être au format YYYY-MM-DD';
$GLOBALS['movie-form-exception-duration'] = 'La durée du film est obligatoire et doit être un nombre entier positif';
$GLOBALS['movie-form-exception-poster'] = 'L\'affiche du film est obligatoire et doit être au format .jpg, .jpeg, ou .png';
$GLOBALS['movie-form-exception-synopsis'] = 'Le synopsis du film est obligatoire et doit contenir entre 10 et 500 caractères';
$GLOBALS['movie-form-exception-trailer'] = 'La bande-annonce du film est obligatoire et doit être une URL valide vers une vidéo YouTube, Dailymotion, ou Vimeo';
$GLOBALS['movie-form-exception-tags'] = 'Le film doit avoir au moins un tag';
$GLOBALS['movie-form-exception-age-rating'] = 'La classification du film est obligatoire et doit être un nombre entier positif';
$GLOBALS['movie-form-exception-seen'] = 'La valeur de \'\'Vu\'\' doit être vraie ou fausse. Le film ne peut pas avoir été vu si il n\'est pas sorti';
$GLOBALS['movie-form-exception-actor-role'] = 'Le rôle doit être défini pour chaque acteur';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Films';
$GLOBALS['all-movies-filter-by-tag'] = 'Filtrer par tag';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Peoples';

////////// HOME //////////
// home.php
$GLOBALS['home-most-popular-title'] = 'Films les plus populaires';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-directors'] = 'Réalisateur(s)';
$GLOBALS['movie-actors'] = 'Acteur(s)';
$GLOBALS['movie-composers'] = 'Compositeur(s)';
$GLOBALS['movie-error-1'] = 'Aucun ID de film fourni';
$GLOBALS['movie-error-2'] = 'Aucun film trouvé avec l\'ID : ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'Aucun ID de personne fourni';
$GLOBALS['person-error-2'] = 'Aucune personne trouvée avec l\'ID : ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Veuillez vous connecter';
$GLOBALS['login-user'] = 'Nom d\'utilisateur';
$GLOBALS['login-password'] = 'Mot de passe';
$GLOBALS['login-submit'] = 'Connexion';
$GLOBALS['login-error'] = 'Nom d\'utilisateur ou mot de passe incorrect, veuillez réessayer';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Erreur de connexion à la base de données : ';
$GLOBALS['pdo-execute-error'] = 'Erreur lors de l\'exécution de la requête : ';

////////// AJAX //////////
// get-data.php
$GLOBALS['ajax-get-data-table-not-valid'] = 'La table demandée n\'est pas valide. Les tables valides sont : movies, tag, et person';
$GLOBALS['ajax-get-data-attribute-value-not-set'] = 'L\'attribut et/ou la valeur ne sont pas définis';
$GLOBALS['ajax-get-data-table-not-set'] = 'La table n\'est pas définie';
// addTag.php
$GLOBALS['tag-add-success'] = 'Tag ajouté avec succès';
$GLOBALS['tag-add-failure'] = 'Le tag existe déjà';
// get-localized-text.php
$GLOBALS['error-no-language'] = 'Aucune langue fournie';
$GLOBALS['error-text-not-found'] = 'Texte introuvable';
$GLOBALS['error-no-text'] = 'Aucun texte fourni';
// getAllPeoples.php
$GLOBALS['person-fetch-success'] = 'Personnes récupérées avec succès';
$GLOBALS['person-fetch-failure'] = 'Échec de la récupération des personnes';
// getMoviesByTag.php
$GLOBALS['error-tag-id-missing'] = 'L\'ID du tag est manquant';
// language.php
$GLOBALS['error-no-method'] = 'Aucune méthode fournie';
$GLOBALS['error-invalid-method'] = 'Méthode invalide';
$GLOBALS['error-no-language'] = 'Aucune langue fournie';
$GLOBALS['error-cookie-not-set'] = 'Impossible de définir le cookie';
// movieFormAddPerson.php
$GLOBALS['error-person-not-found'] = 'Personne non trouvée';

// allMovies.php
$GLOBALS['filter-by-tag'] = 'Filtrer par tag';
$GLOBALS['all'] = 'Tous';
$GLOBALS['movies'] = 'FILMS';

// allPeople.php
$GLOBALS['peoples'] = 'PERSONNES';