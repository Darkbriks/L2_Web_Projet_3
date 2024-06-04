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
$GLOBALS['header-search'] = 'Suche';
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
$GLOBALS['movie-form-add-movie-image'] = 'Bild';
$GLOBALS['movie-form-add-movie-score'] = 'Bewertung';
$GLOBALS['update-movie-form-title'] = 'Wählen Sie einen Film aus, den Sie ändern möchten';
$GLOBALS['update-movie-form-question'] = 'Diesen Film ändern';
$GLOBALS['delete-movie-form'] = 'Diesen Film löschen';
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
$GLOBALS['movie-form-exception-seen'] = 'Der Filmstatus \'\'gesehen\'\' muss wahr oder falsch sein. Der Film kann nicht gesehen werden, wenn er noch nicht veröffentlicht ist';
$GLOBALS['movie-form-exception-actor-role'] = 'Die Rolle muss für jeden Schauspieler festgelegt werden';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Eine Person hinzufügen';
$GLOBALS['update-person-form-title'] = 'Eine Person ändern';
$GLOBALS['update-person-form-question'] = 'Wählen Sie eine Person aus, die Sie ändern möchten';
$GLOBALS['delete-person-form'] = 'Diese Person löschen';
$GLOBALS['update-person-form-submit']= 'Ändern';
$GLOBALS['person-form-add-person-first-name'] = 'Vorname';
$GLOBALS['person-form-add-person-last-name'] = 'Nachname';
$GLOBALS['person-form-add-person-birth-date'] = 'Geburtsdatum';
$GLOBALS['person-form-add-person-death-date'] = 'Todesdatum';
$GLOBALS['person-form-add-person-image'] = 'Bild';
$GLOBALS['person-form-add-person-submit'] = 'Hinzufügen';
$GLOBALS['person-form-exception-adding'] = 'Fehler beim Hinzufügen der Person zur Datenbank';
$GLOBALS['person-form-exception-first-name'] = 'Der Vorname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen enthalten';
$GLOBALS['person-form-exception-last-name'] = 'Der Nachname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen enthalten';
$GLOBALS['person-form-exception-birth-date'] = 'Das Geburtsdatum der Person ist erforderlich und muss im Format JJJJ-MM-TT vorliegen';
$GLOBALS['person-form-exception-death-date'] = 'Das Todesdatum der Person muss im Format JJJJ-MM-TT vorliegen';
$GLOBALS['person-form-exception-image'] = 'Fehler beim Hochladen des Bildes';
$GLOBALS['person-form-exception-upload'] = 'Fehler beim Hochladen des Bildes';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Filme';
$GLOBALS['all-movies-filter-by-tag'] = 'Nach Tag filtern';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Personen';

////////// HOME //////////
// home.php
$GLOBALS['home-most-popular-title'] = 'Beliebteste Filme';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-time-duration'] = 'Dauer';
$GLOBALS['movie-rating'] = 'Bewertung';
$GLOBALS['movie-note'] = 'Notiz';
$GLOBALS['movie-vu'] = 'Gesehen';
$GLOBALS['movie-synopsis'] = 'Zusammenfassung';
$GLOBALS['movie-minutes'] = 'Minuten';
$GLOBALS['movie-rating-1'] = 'Jeder';
$GLOBALS['movie-rating-2'] = 'Jahre und älter';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Bearbeiten';
$GLOBALS['movie-save-vu'] = 'Speichern';
$GLOBALS['movie-directors'] = 'Regisseur(en)';
$GLOBALS['movie-actors'] = 'Schauspieler';
$GLOBALS['movie-composers'] = 'Komponist(en)';
$GLOBALS['movie-error-1'] = 'Keine Film-ID angegeben';
$GLOBALS['movie-error-2'] = 'Kein Film gefunden mit ID : ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'Keine Person-ID angegeben';
$GLOBALS['person-error-2'] = 'Keine Person gefunden mit ID : ';

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

////////// API //////////
// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'Kein Tag angegeben';
$GLOBALS['api-add-tag-error-2'] = 'Fehler beim Hinzufügen des Tags zur Datenbank';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'Angeforderte Tabelle ist ungültig. Gültige Tabellen sind: movies, tag und person';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'Attribut und/oder Wert nicht festgelegt';
$GLOBALS['api-get-data-table-not-set'] = 'Tabelle nicht festgelegt';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'Keine Sprache angegeben';
$GLOBALS['api-get-localized-text-error-2'] = 'Kein Text angegeben';
$GLOBALS['api-get-localized-text-error-3'] = 'Text nicht gefunden';

// getMoviesByTag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'Keine Tag-ID angegeben';

// language.php
$GLOBALS['api-language-error-1'] = 'Keine Methode angegeben';
$GLOBALS['api-language-error-2'] = 'Ungültige Sprache';
$GLOBALS['api-language-error-3'] = 'Sprache nicht festgelegt';
$GLOBALS['api-language-error-4'] = 'Fehler beim Festlegen der Sprache';


// set-seen.php
$GLOBALS['api-set-seen-error-1'] = 'Keine Film-ID angegeben';
$GLOBALS['api-set-seen-error-2'] = 'Fehler beim Aktualisieren des \'Gesehen\'-Attributs';
$GLOBALS['api-set-seen-success'] = 'Attribut \'Gesehen\' erfolgreich aktualisiert';