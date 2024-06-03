<?php
////////// DE //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'Meine Filme';
$GLOBALS['template-light-theme'] = 'Lichtmodus';
$GLOBALS['template-dark-theme'] = 'Dunkelmodus';

// header.php
$GLOBALS['header-title'] = 'Heimat der Filme';
$GLOBALS['header-home'] = 'Startseite';
$GLOBALS['header-movies'] = 'Filme';
$GLOBALS['header-peoples'] = 'Personen';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-logout'] = 'Abmelden';
$GLOBALS['header-theme'] = 'Thema';
$GLOBALS['header-language-dropdown-default'] = 'Sprache wählen';

// footer.php
$GLOBALS['footer-text'] = 'Elementquellen ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Film erfolgreich hinzugefügt';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Einen Film hinzufügen';
$GLOBALS['movie-form-add-movie-title'] = 'Titel';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Filmtitel eingeben';
$GLOBALS['movie-form-add-movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-form-add-movie-duration'] = 'Dauer';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Filmdauer eingeben';
$GLOBALS['movie-form-add-movie-poster'] = 'Poster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Entfernen';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Zusammenfassung';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Filmbeschreibung eingeben';
$GLOBALS['movie-form-add-movie-trailer'] = 'Trailer';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Filmtrailer eingeben';
$GLOBALS['movie-form-add-movie-tags'] = 'Stichwörter';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Neues Stichwort';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Stichwort hinzufügen';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Altersfreigabe';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Altersfreigabe des Films eingeben';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Für alle Altersgruppen';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'Jahre und älter';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Regisseur-Liste';
$GLOBALS['movie-form-add-movie-add-director'] = 'Regisseur hinzufügen';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Schauspielerliste';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Schauspieler hinzufügen';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Komponistenliste';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Komponist hinzufügen';
$GLOBALS['movie-form-add-movie-seen'] = 'Gesehen';
$GLOBALS['movie-form-add-movie-add'] = 'Hinzufügen';
$GLOBALS['movie-form-add-movie-cancel'] = 'Abbrechen';
$GLOBALS['movie-form-exception-adding'] = 'Fehler beim Hinzufügen des Films zur Datenbank';
$GLOBALS['movie-form-exception-upload'] = 'Fehler beim Hochladen des Posters';
$GLOBALS['movie-form-exception-title'] = 'Der Filmtitel ist erforderlich und muss zwischen 3 und 50 Zeichen enthalten';
$GLOBALS['movie-form-exception-release-date'] = 'Das Veröffentlichungsdatum des Films ist erforderlich und muss im Format JJJJ-MM-TT vorliegen';
$GLOBALS['movie-form-exception-duration'] = 'Die Filmdauer ist erforderlich und muss eine positive ganze Zahl sein';
$GLOBALS['movie-form-exception-poster'] = 'Das Filmplakat ist erforderlich und muss im Format .jpg, .jpeg oder .png vorliegen';
$GLOBALS['movie-form-exception-synopsis'] = 'Die Zusammenfassung des Films ist erforderlich und muss zwischen 10 und 500 Zeichen enthalten';
$GLOBALS['movie-form-exception-trailer'] = 'Der Filmtrailer ist erforderlich und muss eine gültige URL von Youtube, Dailymotion oder Vimeo sein';
$GLOBALS['movie-form-exception-tags'] = 'Der Film muss mindestens ein Stichwort haben';
$GLOBALS['movie-form-exception-age-rating'] = 'Die Altersfreigabe des Films ist erforderlich und muss eine positive ganze Zahl sein';
$GLOBALS['movie-form-exception-seen'] = 'Der Filmstatus "gesehen" muss wahr oder falsch sein. Der Film kann nicht gesehen werden, wenn er noch nicht veröffentlicht ist';
$GLOBALS['movie-form-exception-actor-role'] = 'Die Rolle muss für jeden Schauspieler festgelegt werden';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Bitte anmelden';
$GLOBALS['login-user'] = 'Benutzername';
$GLOBALS['login-password'] = 'Passwort';
$GLOBALS['login-submit'] = 'Anmelden';
$GLOBALS['login-error'] = 'Benutzername oder Passwort falsch, bitte erneut versuchen';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Fehler beim Verbinden mit der Datenbank: ';
$GLOBALS['pdo-execute-error'] = 'Fehler beim Ausführen der Abfrage: ';

////////// AJAX //////////
// get-data.php
$GLOBALS['ajax-get-data-table-not-valid'] = 'Die angeforderte Tabelle ist nicht gültig. Gültige Tabellen sind: movies, tag und person';
$GLOBALS['ajax-get-data-attribute-value-not-set'] = 'Das Attribut und/oder der Wert sind nicht gesetzt';
$GLOBALS['ajax-get-data-table-not-set'] = 'Die Tabelle ist nicht gesetzt';
// addTag.php
$GLOBALS['tag-add-success'] = 'Tag erfolgreich hinzugefügt';
$GLOBALS['tag-add-failure'] = 'Tag existiert bereits';
// get-localized-text.php
$GLOBALS['error-no-language'] = 'Keine Sprache angegeben';
$GLOBALS['error-text-not-found'] = 'Text nicht gefunden';
$GLOBALS['error-no-text'] = 'Kein Text angegeben';
// getAllPeoples.php
$GLOBALS['person-fetch-success'] = 'Personen erfolgreich abgerufen';
$GLOBALS['person-fetch-failure'] = 'Abrufen der Personen fehlgeschlagen';
// getMoviesByTag.php
$GLOBALS['error-tag-id-missing'] = 'Tag-ID fehlt';
// language.php
$GLOBALS['error-no-method'] = 'Keine Methode angegeben';
$GLOBALS['error-invalid-method'] = 'Ungültige Methode';
$GLOBALS['error-no-language'] = 'Keine Sprache angegeben';
$GLOBALS['error-cookie-not-set'] = 'Cookie konnte nicht gesetzt werden';
// movieFormAddPerson.php
$GLOBALS['error-person-not-found'] = 'Person nicht gefunden';

// allMovies.php
$GLOBALS['filter-by-tag'] = 'Nach Tag filtern';
$GLOBALS['all'] = 'Alle';
$GLOBALS['movies'] = 'FILME';


// allPeople.php
$GLOBALS['peoples'] = 'PERSONEN';
