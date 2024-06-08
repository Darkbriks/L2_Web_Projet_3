<?php
//////////DE//////////

////////// GLOBALE AUSDRÜCKE //////////
$GLOBALS['still-alive'] = 'Noch am Leben';
$GLOBALS['edit'] = 'Bearbeiten';
$GLOBALS['save-changes'] = 'Änderungen Speichern';
$GLOBALS['cancel'] = 'Abbrechen';
$GLOBALS['error-unknown-type'] = 'Fehler: Unbekannter Typ';

////////// VORLAGE //////////
// template.php
$GLOBALS['template-title'] = 'Meine Filme';
$GLOBALS['template-light-theme'] = 'Helles Thema';
$GLOBALS['template-dark-theme'] = 'Dunkles Thema';

// header.php
$GLOBALS['header-title'] = 'Film Startseite';
$GLOBALS['header-home'] = 'Startseite';
$GLOBALS['header-movies'] = 'Filme';
$GLOBALS['header-peoples'] = 'Personen';
$GLOBALS['header-favorites'] = 'Favoriten';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-advanced-search'] = 'Erweiterte Suche';
$GLOBALS['header-search'] = 'Suche';
$GLOBALS['header-logout'] = 'Abmelden';
$GLOBALS['header-login'] = 'Anmelden';
$GLOBALS['header-theme'] = 'Thema';
$GLOBALS['header-language-dropdown-default'] = 'Sprache Wählen';

// footer.php
$GLOBALS['footer-text'] = 'Quelle der Elemente ...';

////////// ADMIN //////////
// admin.php
// hinzufügen
$GLOBALS['admin-movie-success'] = 'Film erfolgreich hinzugefügt';
$GLOBALS['admin-person-success'] = 'Person erfolgreich hinzugefügt';
// aktualisieren
$GLOBALS['admin-movie-update-success'] = 'Film erfolgreich aktualisiert';
$GLOBALS['admin-person-update-success'] = 'Person erfolgreich aktualisiert';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Einen Film Hinzufügen';
$GLOBALS['movie-form-add-movie-title'] = 'Titel';
$GLOBALS['movie-form-add-movie-image'] = 'Bild';
$GLOBALS['movie-form-add-movie-score'] = 'Bewertung';
$GLOBALS['update-form-link-title'] = 'Einen Link Hinzufügen';
$GLOBALS['update-form-link'] = 'Einen Link Hinzufügen';
$GLOBALS['delete-form-link'] = 'Link Entfernen';
$GLOBALS['update-movie-form-title'] = 'Wählen Sie Einen Film Zum Aktualisieren';
$GLOBALS['update-movie-form-question'] = 'Diesen Film Aktualisieren';
$GLOBALS['delete-movie-form'] = 'Diesen Film Löschen';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Filmtitel Eingeben';
$GLOBALS['movie-form-add-movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-form-add-movie-duration'] = 'Dauer';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Filmdauer Eingeben';
$GLOBALS['movie-form-add-movie-poster'] = 'Poster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Entfernen';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Zusammenfassung';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Zusammenfassung Eingeben';
$GLOBALS['movie-form-add-movie-trailer'] = 'Trailer';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Trailer-URL Eingeben';
$GLOBALS['movie-form-add-movie-tags'] = 'Tags';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Neuer Tag';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Tag Hinzufügen';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Altersfreigabe';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Altersfreigabe Eingeben';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Für Alle Altersgruppen';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'Jahre und Älter';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Regisseure';
$GLOBALS['movie-form-add-movie-add-director'] = 'Regisseur Hinzufügen';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Schauspieler';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Schauspieler Hinzufügen';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Komponisten';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Komponist Hinzufügen';
$GLOBALS['movie-form-add-played'] = 'Rolle Gespielt';
$GLOBALS['movie-form-add-movie-seen'] = 'Gesehen';
$GLOBALS['movie-form-add-movie-add'] = 'Hinzufügen';
$GLOBALS['movie-form-add-movie-cancel'] = 'Abbrechen';
$GLOBALS['movie-form-exception-adding'] = 'Fehler beim Hinzufügen des Films zur Datenbank';
$GLOBALS['movie-form-exception-upload'] = 'Fehler beim Hochladen des Posters';
$GLOBALS['movie-form-exception-title'] = 'Filmtitel ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['movie-form-exception-release-date'] = 'Veröffentlichungsdatum muss im Format JJJJ-MM-TT sein';
$GLOBALS['movie-form-exception-duration'] = 'Filmdauer ist erforderlich und muss eine positive Ganzzahl sein';
$GLOBALS['movie-form-exception-poster'] = 'Filmplakat ist erforderlich und muss im Format .jpg, .jpeg oder .png sein';
$GLOBALS['movie-form-exception-synopsis'] = 'Zusammenfassung ist erforderlich und muss zwischen 10 und 500 Zeichen lang sein';
$GLOBALS['movie-form-exception-trailer'] = 'Filmtrailer ist erforderlich und muss eine gültige URL zu einem YouTube-, Dailymotion- oder Vimeo-Video sein';
$GLOBALS['movie-form-exception-tags'] = 'Der Film muss mindestens einen Tag haben';
$GLOBALS['movie-form-exception-age-rating'] = 'Altersfreigabe ist erforderlich und muss eine positive Ganzzahl sein';
$GLOBALS['movie-form-exception-seen'] = 'Der "Gesehen" Wert muss wahr oder falsch sein. Der Film kann nicht als gesehen markiert werden, wenn er nicht veröffentlicht ist';
$GLOBALS['movie-form-exception-actor-role'] = 'Rolle muss für jeden Schauspieler definiert sein';

// update-tag-form.php
$GLOBALS['update-tag-form-title'] = 'Einen Tag Aktualisieren';
$GLOBALS['update-tag-form-submit'] = 'Aktualisieren';
$GLOBALS['update-tag-form-name'] = 'Tag-Name';
$GLOBALS['update-tag-form-question'] = 'Wählen Sie Einen Tag Zum Aktualisieren';
$GLOBALS['delete-tag-form'] = 'Tag Löschen';
$GLOBALS['tag-form-exception-name'] = 'Tag-Name muss zwischen 3 und 50 Zeichen lang sein';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Eine Person Hinzufügen';
$GLOBALS['person-form-type'] = 'Personentyp';
$GLOBALS['update-person-form-title'] = 'Eine Person Aktualisieren';
$GLOBALS['update-person-form-question'] = 'Wählen Sie Eine Person Zum Aktualisieren';
$GLOBALS['delete-person-form'] = 'Diese Person Löschen';
$GLOBALS['update-person-form-submit'] = 'Aktualisieren';
$GLOBALS['person-form-add-person-first-name'] = 'Vorname';
$GLOBALS['person-form-add-person-last-name'] = 'Nachname';
$GLOBALS['person-form-add-person-birth-date'] = 'Geburtsdatum';
$GLOBALS['person-form-add-person-death-date'] = 'Todesdatum';
$GLOBALS['person-form-add-person-image'] = 'Bild';
$GLOBALS['person-form-add-person-submit'] = 'Hinzufügen';
$GLOBALS['person-form-exception-adding'] = 'Fehler beim Hinzufügen der Person zur Datenbank';
$GLOBALS['person-form-exception-first-name'] = 'Vorname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['person-form-exception-last-name'] = 'Nachname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['person-form-exception-birth-date'] = 'Geburtsdatum der Person ist erforderlich, muss im Format JJJJ-MM-TT sein und muss in der Vergangenheit liegen';
$GLOBALS['person-form-exception-death-date'] = 'Todesdatum der Person muss leer oder ein Datum in der Vergangenheit sein';
$GLOBALS['person-form-exception-image'] = 'Bild der Person ist erforderlich und muss im Format .jpg, .jpeg oder .png sein';
$GLOBALS['person-form-exception-upload'] = 'Fehler beim Hochladen des Bildes';

////////// ERWEITERTE SUCHE //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Erweiterte Filmsuche';
$GLOBALS['advanced-search-movie-add-filter'] = 'Filter Hinzufügen';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Attribut';
$GLOBALS['advanced-search-movie-filter-value'] = 'Wert';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Entfernen';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Wählen...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Titel';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Dauer';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Zusammenfassung';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Trailer';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Tags';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Altersfreigabe';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Regisseur(e)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Schauspieler';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Komponisten';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Gesehen';
$GLOBALS['advanced-search-movie-filter-value-like'] = 'Gefällt';
$GLOBALS['advanced-search-movie-filter-value-not-like'] = 'Gefällt Nicht';
$GLOBALS['advanced-search-movie-filter-value-equal'] = 'Gleich';
$GLOBALS['advanced-search-movie-filter-value-not-equal'] = 'Ungleich';
$GLOBALS['advanced-search-movie-filter-value-greater-than'] = 'Größer Als';
$GLOBALS['advanced-search-movie-filter-value-less-than'] = 'Kleiner Als';
$GLOBALS['advanced-search-movie-filter-value-and'] = 'UND';
$GLOBALS['advanced-search-movie-filter-value-or'] = 'ODER';

// advanced-search-person.php
$GLOBALS['advanced-search-person-modal-title'] = 'Erweiterte Personensuche';
$GLOBALS['advanced-search-person-add-filter'] = 'Filter Hinzufügen';
$GLOBALS['advanced-search-person-filter-attribute'] = 'Attribut';
$GLOBALS['advanced-search-person-filter-value'] = 'Wert';
$GLOBALS['advanced-search-person-filter-remove'] = 'Entfernen';
$GLOBALS['advanced-search-person-filter-attribute-choose'] = 'Wählen...';
$GLOBALS['advanced-search-person-filter-attribute-first-name'] = 'Vorname';
$GLOBALS['advanced-search-person-filter-attribute-last-name'] = 'Nachname';
$GLOBALS['advanced-search-person-filter-attribute-birth-date'] = 'Geburtsdatum';
$GLOBALS['advanced-search-person-filter-attribute-death-date'] = 'Todesdatum';
$GLOBALS['advanced-search-person-filter-attribute-role'] = 'Rolle';
$GLOBALS['advanced-search-person-filter-attribute-image'] = 'Bild';
$GLOBALS['advanced-search-person-filter-value-like'] = 'Gefällt';
$GLOBALS['advanced-search-person-filter-value-not-like'] = 'Gefällt Nicht';
$GLOBALS['advanced-search-person-filter-value-equal'] = 'Gleich';
$GLOBALS['advanced-search-person-filter-value-not-equal'] = 'Ungleich';
$GLOBALS['advanced-search-person-filter-value-greater-than'] = 'Größer Als';
$GLOBALS['advanced-search-person-filter-value-less-than'] = 'Kleiner Als';
$GLOBALS['advanced-search-person-filter-value-and'] = 'UND';
$GLOBALS['advanced-search-person-filter-value-or'] = 'ODER';

////////// FAVORITEN //////////
$GLOBALS['favorites-title'] = 'Ihre Favoriten';

////////// ALLE FILME //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Filme';
$GLOBALS['all-movies-filter-by-tag'] = 'Nach Tag Filtern';

////////// ALLE PERSONEN //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Personen';

////////// STARTSEITE //////////
// home.php
$GLOBALS['home-discover-title'] = 'Filmentdeckungen';
$GLOBALS['random-home-title'] = 'Zufällige Filme';

////////// FILM //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-time-duration'] = 'Dauer';
$GLOBALS['movie-rating'] = 'Bewertung';
$GLOBALS['movie-note'] = 'Notiz';
$GLOBALS['movie-vu'] = 'Gesehen';
$GLOBALS['movie-favorite'] = 'Favorit';
$GLOBALS['movie-minutes'] = 'Minuten';
$GLOBALS['movie-rating-1'] = 'Alle Altersgruppen';
$GLOBALS['movie-rating-2'] = 'Jahre und Älter';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Bearbeiten';
$GLOBALS['movie-save-vu'] = 'Speichern';
$GLOBALS['movie-synopsis'] = 'Zusammenfassung';
$GLOBALS['movie-directors'] = 'Regisseure';
$GLOBALS['movie-director'] = 'Regisseur';
$GLOBALS['movie-composer'] = 'Komponist';
$GLOBALS['movie-actors'] = 'Schauspieler';
$GLOBALS['movie-actor'] = 'Schauspieler';
$GLOBALS['movie-composers'] = 'Komponisten';
$GLOBALS['movie-error-1'] = 'Keine Film-ID angegeben';
$GLOBALS['movie-error-2'] = 'Kein Film mit der ID gefunden: ';

// EditableMovie.php
$GLOBALS['movie-edit'] = 'Bearbeiten';
$GLOBALS['movie-save-changes'] = 'Änderungen Speichern';
$GLOBALS['movie-cancel'] = 'Abbrechen';
$GLOBALS['movie-editable-new-title'] = 'Neuer Titel';
$GLOBALS['movie-editable-new-release-date'] = 'Neues Veröffentlichungsdatum';
$GLOBALS['movie-editable-new-synopsis'] = 'Neue Zusammenfassung';
$GLOBALS['movie-editable-new-time-duration'] = 'Neue Dauer';
$GLOBALS['movie-editable-new-note'] = 'Neue Notiz';
$GLOBALS['movie-editable-new-rating'] = 'Neue Bewertung';
$GLOBALS['movie-editable-error-unknown-type'] = 'Fehler: Unbekannter Typ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'Keine Personen-ID angegeben';
$GLOBALS['person-error-2'] = 'Keine Person mit der ID gefunden: ';
$GLOBALS['person-first-name'] = 'Vorname';
$GLOBALS['person-last-name'] = 'Nachname';
$GLOBALS['person-birth-date'] = 'Geburtsdatum';
$GLOBALS['person-death-date'] = 'Todesdatum';

////////// ANMELDUNG //////////
// login.php
$GLOBALS['login-title'] = 'Bitte Anmelden';
$GLOBALS['login-user'] = 'Benutzername';
$GLOBALS['login-password'] = 'Passwort';
$GLOBALS['login-submit'] = 'Anmelden';
$GLOBALS['login-error'] = 'Falscher Benutzername oder Passwort, bitte versuchen Sie es erneut';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Datenbankverbindungsfehler: ';
$GLOBALS['pdo-execute-error'] = 'Fehler bei der Ausführung der Abfrage: ';

// MovieDB.php
$GLOBALS['movie-db-already-exists'] = 'Film existiert bereits';

// PersonDB.php
$GLOBALS['person-db-already-exists'] = 'Person existiert bereits';

// TagDB.php
$GLOBALS['tag-db-already-exists'] = 'Tag existiert bereits';

////////// API //////////
// add-person.php
$GLOBALS['api-add-person-error-1'] = 'Kein Vorname angegeben';

// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'Kein Tag angegeben';
$GLOBALS['api-add-tag-error-2'] = 'Fehler beim Hinzufügen des Tags. Bitte stellen Sie sicher, dass der Tag nicht bereits existiert';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'Angeforderte Tabelle ist nicht gültig. Gültige Tabellen sind: filme, tag und person';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'Attribut und/oder Wert nicht festgelegt';
$GLOBALS['api-get-data-table-not-set'] = 'Tabelle nicht festgelegt';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'Keine Sprache angegeben';
$GLOBALS['api-get-localized-text-error-2'] = 'Text nicht gefunden';
$GLOBALS['api-get-localized-text-error-3'] = 'Kein Text angegeben';

// get-movies-by-tag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'Tag-ID fehlt';

// language.php
$GLOBALS['api-language-error-1'] = 'Keine Methode angegeben';
$GLOBALS['api-language-error-2'] = 'Ungültige Methode';
$GLOBALS['api-language-error-3'] = 'Ungültige Sprache';
$GLOBALS['api-language-error-4'] = 'Fehler beim Ändern der Sprache';

// set-seen-favorite.php
$GLOBALS['api-set-seen-error-1'] = 'Keine Film-ID angegeben';
$GLOBALS['api-set-seen-error-2'] = 'Kein "Gesehen"-Parameter angegeben';
$GLOBALS['api-set-seen-success'] = '"Gesehen"-Attribut erfolgreich aktualisiert';
