<?php
////////// FR //////////

////////// GLOBAL EXPRESSIONS //////////
$GLOBALS['still-alive'] = 'Encore en vie';
$GLOBALS['edit'] = 'Modifier';
$GLOBALS['save-changes'] = 'Sauvegarder les modifications';
$GLOBALS['cancel'] = 'Annuler';
$GLOBALS['error-unknown-type'] = 'Erreur: type inconnu';

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
$GLOBALS['header-favorites'] = 'Favoris';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-advanced-search'] = 'Recherche avancée';
$GLOBALS['header-search'] = 'Rechercher';
$GLOBALS['header-logout'] = 'Déconnexion';
$GLOBALS['header-login'] = 'Connexion';
$GLOBALS['header-theme'] = 'Thème';
$GLOBALS['header-language-dropdown-default'] = 'Choisir la langue';

// footer.php
$GLOBALS['footer-text'] = 'Sources des éléments ...';

////////// ADMIN //////////
// admin.php
//add
$GLOBALS['admin-movie-success'] = 'Film ajouté avec succès';
$GLOBALS['admin-person-success'] = 'Personne ajoutée avec succès';
//update
$GLOBALS['admin-movie-update-success'] = 'Film modifié avec succès';
$GLOBALS['admin-person-update-success'] = 'Personne modifiée avec succès';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Ajouter un film';
$GLOBALS['movie-form-add-movie-title'] = 'Titre';
$GLOBALS['movie-form-add-movie-image'] = 'Image';
$GLOBALS['movie-form-add-movie-score'] = 'Note';
$GLOBALS['update-form-link-title'] = 'Ajouter un lien';
$GLOBALS['update-form-link'] = 'Ajouter un lien';
$GLOBALS['delete-form-link'] = 'Supprimer le lien';
$GLOBALS['update-movie-form-title'] = 'Choisir un film à modifier';
$GLOBALS['update-movie-form-question'] = 'Modifier ce film';
$GLOBALS['delete-movie-form'] = 'Supprimer ce film';
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
$GLOBALS['movie-form-add-played'] = 'Rôle joué';
$GLOBALS['movie-form-add-movie-seen'] = 'Vu';
$GLOBALS['movie-form-add-movie-add'] = 'Ajouter';
$GLOBALS['movie-form-add-movie-cancel'] = 'Annuler';
$GLOBALS['movie-form-exception-adding'] = 'Erreur lors de l\'ajout du film à la base de données';
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


//update-tag-form.php
$GLOBALS['update-tag-form-title']='Modifier un tag';
$GLOBALS['update-tag-form-submit']='Modifier';
$GLOBALS['update-tag-form-name']='Nom du tag';
$GLOBALS['update-tag-form-question']='Choisir un tag à mettre à jour ';
$GLOBALS['delete-tag-form']='Supprimer le tag';
$GLOBALS['tag-form-exception-name'] = 'Le nom du tag doit comporter entre 3 et 50 caractères';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Ajouter une personne';
$GLOBALS['person-form-type'] = 'Type de personne';
$GLOBALS['update-person-form-title'] = 'Modifier une personne';
$GLOBALS['update-person-form-question'] = 'Choisissez une personne à modifier';
$GLOBALS['delete-person-form'] = 'Supprimer cette personne';
$GLOBALS['update-person-form-submit']= 'Modifier';
$GLOBALS['person-form-add-person-first-name'] = 'Prénom';
$GLOBALS['person-form-add-person-last-name'] = 'Nom de famille';
$GLOBALS['person-form-add-person-birth-date'] = 'Date de naissance';
$GLOBALS['person-form-add-person-death-date'] = 'Date de décès';
$GLOBALS['person-form-add-person-image'] = 'Image';
$GLOBALS['person-form-add-person-submit'] = 'Ajouter';
$GLOBALS['person-form-exception-adding'] = 'Erreur lors de l\'ajout de la personne dans la base de données';
$GLOBALS['person-form-exception-first-name'] = 'Le prénom de la personne est obligatoire et doit contenir entre 3 et 50 caractères';
$GLOBALS['person-form-exception-last-name'] = 'Le nom de famille de la personne est obligatoire et doit contenir entre 3 et 50 caractères';
$GLOBALS['person-form-exception-birth-date'] = 'La date de naissance de la personne est obligatoire, doit être au format YYYY-MM-DD et doit être une date passée';
$GLOBALS['person-form-exception-death-date'] = 'La date de décès de la personne doit être vide ou une date passée';
$GLOBALS['person-form-exception-image'] = 'L\'image de la personne est obligatoire et doit être au format .jpg, .jpeg, ou .png';
$GLOBALS['person-form-exception-upload'] = 'Erreur lors du téléchargement de l\'image';

////////// ADVANCED SEARCH //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Recherche avancée de films';
$GLOBALS['advanced-search-movie-add-filter'] = 'Ajouter un filtre';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Attribut';
$GLOBALS['advanced-search-movie-filter-value'] = 'Valeur';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Supprimer';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Choisir...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Titre';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Date de sortie';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Durée';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Synopsis';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Bande-annonce';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Tags';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Classification';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Réalisateur(s)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Acteur(s)';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Compositeur(s)';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Vu';
$GLOBALS['advanced-search-movie-filter-value-like'] = 'Comme';
$GLOBALS['advanced-search-movie-filter-value-not-like'] = 'Pas comme';
$GLOBALS['advanced-search-movie-filter-value-equal'] = 'Égal';
$GLOBALS['advanced-search-movie-filter-value-not-equal'] = 'Pas égal';
$GLOBALS['advanced-search-movie-filter-value-greater-than'] = 'Plus grand que';
$GLOBALS['advanced-search-movie-filter-value-less-than'] = 'Moins que';
$GLOBALS['advanced-search-movie-filter-value-seen'] = 'Vu';
$GLOBALS['advanced-search-movie-filter-value-not-seen'] = 'Non vu';
$GLOBALS['advanced-search-movie-filter-value-and'] = 'ET';
$GLOBALS['advanced-search-movie-filter-value-OR'] = 'OU';

// advanced-search-person.php
$GLOBALS['advanced-search-person-modal-title'] = 'Recherche avancée de personne';
$GLOBALS['advanced-search-person-first-name'] = 'Prénom';
$GLOBALS['advanced-search-person-last-name'] = 'Nom de famille';
$GLOBALS['advanced-search-person-birth-date'] = 'Date de naissance';
$GLOBALS['advanced-search-person-death-date'] = 'Date de décès';
$GLOBALS['advanced-search-person-other-person'] = 'Autre personne';
$GLOBALS['advanced-search-person-tag']= 'Tags';
$GLOBALS['advanced-search-movie-filter-value-like'] = 'Comme';
$GLOBALS['advanced-search-person-filter-value-not-like'] = 'Pas comme';
$GLOBALS['advanced-search-person-filter-value-equal'] = 'Égal';
$GLOBALS['advanced-search-person-filter-value-not-equal'] = 'Pas égal';
$GLOBALS['advanced-search-person-filter-value-greater-than'] = 'Supérieur à';
$GLOBALS['advanced-search-person-filter-value-less-than'] = 'Inférieur à';
$GLOBALS['advanced-search-person-filter-value-and'] = 'ET';
$GLOBALS['advanced-search-person-filter-value-OR'] = 'OU';

////////// FAVORITES //////////
$GLOBALS['favorites-title']= 'Vos favoris';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Films';
$GLOBALS['all-movies-filter-by-tag'] = 'Filtrer par tag';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Peoples';

////////// HOME //////////
// home.php
$GLOBALS['home-discover-title'] = 'Découvertes de films';
$GLOBALS['random-home-title'] = 'Films aléatoires';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Date de sortie';
$GLOBALS['movie-time-duration'] = 'Durée';
$GLOBALS['movie-rating'] = 'Classification';
$GLOBALS['movie-note'] = 'Note';
$GLOBALS['movie-vu'] = 'Vu';
$GLOBALS['movie-favorite'] = 'Favori';
$GLOBALS['movie-minutes'] = 'minutes';
$GLOBALS['movie-rating-1'] = 'Tout public';
$GLOBALS['movie-rating-2'] = 'ans et plus';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Modifier';
$GLOBALS['movie-save-vu'] = 'Sauvegarder';
$GLOBALS['movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-directors'] = 'Réalisateur(s)';
$GLOBALS['movie-director'] = 'Réalisateur';
$GLOBALS['movie-composer'] = 'Compositeur';
$GLOBALS['movie-actors'] = 'Acteur(s)';
$GLOBALS['movie-actor'] = 'Acteur';
$GLOBALS['movie-composers'] = 'Compositeur(s)';
$GLOBALS['movie-error-1'] = 'Aucun ID de film fourni';
$GLOBALS['movie-error-2'] = 'Aucun film trouvé avec l\'ID : ';

// EditableMovie.php
$GLOBALS['movie-edit'] = 'Modifier';
$GLOBALS['movie-save-changes'] = 'Sauvegarder les modifications';
$GLOBALS['movie-cancel'] = 'Annuler';
$GLOBALS['movie-editable-new-title'] = 'Nouveau titre';
$GLOBALS['movie-editable-new-release-date'] = 'Nouvelle date de sortie';
$GLOBALS['movie-editable-new-synopsis'] = 'Nouveau synopsis';
$GLOBALS['movie-editable-new-time-duration'] = 'Nouvelle durée';
$GLOBALS['movie-editable-new-note'] = 'Nouvelle note';
$GLOBALS['movie-editable-new-rating'] = 'Nouvelle classification';
$GLOBALS['movie-editable-error-unknown-type'] = 'Erreur: type inconnu';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'Aucun ID de personne fourni';
$GLOBALS['person-error-2'] = 'Aucune personne trouvée avec l\'ID : ';
$GLOBALS['person-first-name'] = 'Prenom';
$GLOBALS['person-last-name'] = 'Nom';
$GLOBALS['person-birth-date'] = 'Date de naissance';
$GLOBALS['person-death-date'] = 'Date de décès';

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

// MovieDB.php
$GLOBALS['movie-db-already-exists'] = 'Le film existe déjà';

// PersonDB.php
$GLOBALS['person-db-already-exists'] = 'La personne existe déjà';

// TagDB.php
$GLOBALS['tag-db-already-exists'] = 'Le tag existe déjà';

////////// API //////////
// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'Aucun tag fourni';
$GLOBALS['api-add-tag-error-2'] = 'Erreur lors de l\'ajout du tag. Veuillez vous assurer que le tag n\'existe pas déjà';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'La table demandée n\'est pas valide. Les tables valides sont : films, tag et personne';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'Attribut et/ou valeur non définis';
$GLOBALS['api-get-data-table-not-set'] = 'Table non définie';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'Aucune langue fournie';
$GLOBALS['api-get-localized-text-error-2'] = 'Texte introuvable';
$GLOBALS['api-get-localized-text-error-3'] = 'Aucun texte fourni';

// get-movies-by-tag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'ID de tag manquant';

// language.php
$GLOBALS['api-language-error-1'] = 'Aucune méthode fournie';
$GLOBALS['api-language-error-2'] = 'Méthode invalide';
$GLOBALS['api-language-error-3'] = 'Langue invalide';
$GLOBALS['api-language-error-4'] = 'Erreur lors du changement de langue';

// set-seen-favorite.php
$GLOBALS['api-set-seen-error-1'] = 'Aucun ID de film fourni';
$GLOBALS['api-set-seen-error-2'] = 'Aucun paramètre \'Vu\' fourni';
$GLOBALS['api-set-seen-success'] = 'Attribut \'Vu\' mis à jour avec succès';