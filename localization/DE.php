<?php
////////// DE //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'Meine Filme';
$GLOBALS['template-light-theme'] = 'Helles Design';
$GLOBALS['template-dark-theme'] = 'Dunkles Design';

// header.php
$GLOBALS['header-title'] = 'Filmstartseite';
$GLOBALS['header-home'] = 'Startseite';
$GLOBALS['header-movies'] = 'Filme';
$GLOBALS['header-peoples'] = 'Personen';
$GLOBALS['header-favorites'] = 'Favoriten';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-advanced-search'] = 'Erweiterte Suche';
$GLOBALS['header-search'] = 'Suchen';
$GLOBALS['header-logout'] = 'Ausloggen';
$GLOBALS['header-login']='Anmelden';
$GLOBALS['header-theme'] = 'Design';
$GLOBALS['header-language-dropdown-default'] = 'Sprache auswählen';

// footer.php
$GLOBALS['footer-text'] = 'Quellen der Elemente ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Film erfolgreich hinzugefügt';
$GLOBALS['admin-person-success'] = 'Person erfolgreich hinzugefügt';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Film hinzufügen';
$GLOBALS['movie-form-add-movie-title'] = 'Titel';
$GLOBALS['movie-form-add-movie-image'] = 'Bild';
$GLOBALS['movie-form-add-movie-score'] = 'Bewertung';
$GLOBALS['update-form-link-title'] = 'Link hinzufügen';
$GLOBALS['update-form-link'] = 'Link hinzufügen';
$GLOBALS['delete-form-link'] = 'Link löschen';
$GLOBALS['update-movie-form-title'] = 'Film bearbeiten';
$GLOBALS['update-movie-form-question'] = 'Diesen Film bearbeiten?';
$GLOBALS['delete-movie-form'] = 'Diesen Film löschen?';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Filmtitel eingeben';
$GLOBALS['movie-form-add-movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-form-add-movie-duration'] = 'Dauer';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Filmdauer eingeben';
$GLOBALS['movie-form-add-movie-poster'] = 'Poster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Entfernen';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Inhalt';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Filminhalt eingeben';
$GLOBALS['movie-form-add-movie-trailer'] = 'Trailer';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Trailer-Link eingeben';
$GLOBALS['movie-form-add-movie-tags'] = 'Tags';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Neuer Tag';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Tag hinzufügen';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Altersfreigabe';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Altersfreigabe eingeben';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Freigegeben ohne Altersbeschränkung';
$GLOBALS['movie-form-add-movie-age-rating-number'] = ' Jahre und älter';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Liste der Regisseure';
$GLOBALS['movie-form-add-movie-add-director'] = 'Regisseur hinzufügen';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Liste der Schauspieler';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Schauspieler hinzufügen';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Liste der Komponisten';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Komponisten hinzufügen';
$GLOBALS['movie-form-add-played'] = 'Gespielte Rolle';
$GLOBALS['movie-form-add-played'] = 'Gespielte Rolle';
$GLOBALS['movie-form-add-movie-seen'] = 'Gesehen';
$GLOBALS['movie-form-add-movie-add'] = 'Hinzufügen';
$GLOBALS['movie-form-add-movie-cancel'] = 'Abbrechen';
$GLOBALS['movie-form-exception-adding'] = 'Fehler beim Hinzufügen des Films zur Datenbank';
$GLOBALS['movie-form-exception-upload'] = 'Fehler beim Hochladen des Bildes';
$GLOBALS['movie-form-exception-title'] = 'Der Filmtitel ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['movie-form-exception-release-date'] = 'Das Veröffentlichungsdatum muss im Format YYYY-MM-DD angegeben werden';
$GLOBALS['movie-form-exception-duration'] = 'Die Filmdauer ist erforderlich und muss eine ganze Zahl sein';
$GLOBALS['movie-form-exception-poster'] = 'Das Filmplakat ist erforderlich und muss im Format .jpg, .jpeg oder .png vorliegen';
$GLOBALS['movie-form-exception-synopsis'] = 'Der Inhalt des Films ist erforderlich und muss zwischen 10 und 500 Zeichen lang sein';
$GLOBALS['movie-form-exception-trailer'] = 'Der Trailer des Films ist erforderlich und muss ein gültiger Link zu einem YouTube-, Dailymotion- oder Vimeo-Video sein';
$GLOBALS['movie-form-exception-tags'] = 'Der Film muss mindestens einen Tag haben';
$GLOBALS['movie-form-exception-age-rating'] = 'Die Altersfreigabe ist erforderlich und muss eine ganze Zahl sein';
$GLOBALS['movie-form-exception-seen'] = 'Der Wert von "Gesehen" muss wahr oder falsch sein. Der Film kann nicht als gesehen markiert werden, wenn er noch nicht veröffentlicht wurde';
$GLOBALS['movie-form-exception-actor-role'] = 'Die Rolle muss für jeden Schauspieler definiert sein';

//update-tag-form.php
$GLOBALS['update-tag-form-title']='Tag bearbeiten';
$GLOBALS['update-tag-form-submit']='Bearbeiten';
$GLOBALS['update-tag-form-name']='Name des Tags';
$GLOBALS['update-tag-form-question']='Wählen Sie einen Tag zum Bearbeiten aus';
$GLOBALS['delete-tag-form']='Tag löschen';
$GLOBALS['tag-form-exception-name'] = 'Der Name des Tags muss zwischen 3 und 50 Zeichen lang sein.';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Person hinzufügen';
$GLOBALS['person-form-type'] = 'Personentyp';
$GLOBALS['update-person-form-title'] = 'Person bearbeiten';
$GLOBALS['update-person-form-question'] = 'Wählen Sie eine Person zum Bearbeiten aus';
$GLOBALS['delete-person-form'] = 'Diese Person löschen';
$GLOBALS['update-person-form-submit']= 'Bearbeiten';
$GLOBALS['person-form-add-person-first-name'] = 'Vorname';
$GLOBALS['person-form-add-person-last-name'] = 'Nachname';
$GLOBALS['person-form-add-person-birth-date'] = 'Geburtsdatum';
$GLOBALS['person-form-add-person-death-date'] = 'Todesdatum';
$GLOBALS['person-form-add-person-image'] = 'Bild';
$GLOBALS['person-form-add-person-submit'] = 'Hinzufügen';
$GLOBALS['person-form-exception-adding'] = 'Fehler beim Hinzufügen der Person zur Datenbank';
$GLOBALS['person-form-exception-first-name'] = 'Der Vorname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['person-form-exception-last-name'] = 'Der Nachname der Person ist erforderlich und muss zwischen 3 und 50 Zeichen lang sein';
$GLOBALS['person-form-exception-birth-date'] = 'Das Geburtsdatum der Person ist erforderlich, muss im Format JJJJ-MM-TT angegeben sein und ein Datum in der Vergangenheit sein';
$GLOBALS['person-form-exception-death-date'] = 'Das Todesdatum der Person muss leer sein oder ein Datum in der Vergangenheit sein';
$GLOBALS['person-form-exception-image'] = 'Das Bild der Person ist erforderlich und muss im .jpg, .jpeg oder .png Format vorliegen';
$GLOBALS['person-form-exception-upload'] = 'Fehler beim Hochladen des Bildes';

////////// ADVANCED SEARCH //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Erweiterte Film-Suche';
$GLOBALS['advanced-search-movie-add-filter'] = 'Filter hinzufügen';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Attribut';
$GLOBALS['advanced-search-movie-filter-value'] = 'Wert';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Entfernen';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Wählen...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Titel';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Dauer';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Inhalt';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Trailer';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Tags';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Altersfreigabe';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Regisseur(e)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Schauspieler(in)';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Komponist(in)';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Gesehen';

////////// FAVORITES //////////
$GLOBALS['favorites-title']= 'Ihre Favoriten';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Filme';
$GLOBALS['all-movies-filter-by-tag'] = 'Nach Tag filtern';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Personen';

////////// HOME //////////
// home.php
$GLOBALS['home-discover-title'] = 'Filme entdecken';
$GLOBALS['random-home-title'] = 'Zufällige Filme';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Veröffentlichungsdatum';
$GLOBALS['movie-time-duration'] = 'Dauer';
$GLOBALS['movie-rating'] = 'Altersfreigabe';
$GLOBALS['movie-note'] = 'Bewertung';
$GLOBALS['movie-vu'] = 'Gesehen';
$GLOBALS['movie-minutes'] = 'Minuten';
$GLOBALS['movie-rating-1'] = 'Freigegeben ohne Altersbeschränkung';
$GLOBALS['movie-rating-2'] = ' Jahre und älter';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Bearbeiten';
$GLOBALS['movie-save-vu'] = 'Speichern';
$GLOBALS['movie-synopsis'] = 'Inhalt';
$GLOBALS['movie-directors'] = 'Regisseur(e)';
$GLOBALS['movie-director'] = 'Regisseur';
$GLOBALS['movie-composer'] = 'Komponist';
$GLOBALS['movie-actors'] = 'Schauspieler(in)';
$GLOBALS['movie-actor'] = 'Schauspieler';
$GLOBALS['movie-composers'] = 'Komponist(in)';
$GLOBALS['movie-error-1'] = 'Keine Film-ID angegeben';
$GLOBALS['movie-error-2'] = 'Kein Film mit der ID gefunden: ';

// EditableObject.php
$GLOBALS['movie-edit'] = 'Bearbeiten';
$GLOBALS['movie-save-changes'] = 'Änderungen speichern';
$GLOBALS['movie-cancel'] = 'Abbrechen';
$GLOBALS['movie-editable-new-title'] = 'Neuer Titel';
$GLOBALS['movie-editable-new-release-date'] = 'Neues Veröffentlichungsdatum';
$GLOBALS['movie-editable-new-synopsis'] = 'Neuer Inhalt';
$GLOBALS['movie-editable-new-time-duration'] = 'Neue Dauer';
$GLOBALS['movie-editable-new-note'] = 'Neue Bewertung';
$GLOBALS['movie-editable-new-rating'] = 'Neue Altersfreigabe';
$GLOBALS['movie-editable-error-unknown-type'] = 'Fehler: unbekannter Typ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'Keine Person-ID angegeben';
$GLOBALS['person-error-2'] = 'Keine Person mit der ID gefunden: ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Bitte anmelden';
$GLOBALS['login-user'] = 'Benutzername';
$GLOBALS['login-password'] = 'Passwort';
$GLOBALS['login-submit'] = 'Anmelden';
$GLOBALS['login-error'] = 'Benutzername oder Passwort sind falsch, bitte erneut versuchen';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Fehler bei der Verbindung zur Datenbank: ';
$GLOBALS['pdo-execute-error'] = 'Fehler bei der Ausführung der Abfrage: ';

// MovieDB.php
$GLOBALS['movie-db-already-exists'] = 'Der Film existiert bereits';

// PersonDB.php
$GLOBALS['person-db-already-exists'] = 'Die Person existiert bereits';

// TagDB.php
$GLOBALS['tag-db-already-exists'] = 'Der Tag existiert bereits';

////////// API //////////
// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'Kein Tag angegeben';
$GLOBALS['api-add-tag-error-2'] = 'Fehler beim Hinzufügen des Tags. Stellen Sie sicher, dass der Tag noch nicht vorhanden ist';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'Die angeforderte Tabelle ist ungültig. Gültige Tabellen sind: movies, tag und person';
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
$GLOBALS['api-set-seen-success'] = 'Attribut "Gesehen" erfolgreich aktualisiert';