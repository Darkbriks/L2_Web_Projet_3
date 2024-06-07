<?php
////////// EN //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'My movies';
$GLOBALS['template-light-theme'] = 'Light theme';
$GLOBALS['template-dark-theme'] = 'Dark theme';

// header.php
$GLOBALS['header-title'] = 'Movie home';
$GLOBALS['header-home'] = 'Home';
$GLOBALS['header-movies'] = 'Movies';
$GLOBALS['header-peoples'] = 'Peoples';
$GLOBALS['header-favorites'] = 'Favorites';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-advanced-search'] = 'Advanced search';
$GLOBALS['header-search'] = 'Search';
$GLOBALS['header-logout'] = 'Logout';
$GLOBALS['header-login']='Login';
$GLOBALS['header-theme'] = 'Theme';
$GLOBALS['header-language-dropdown-default'] = 'Choose language';

// footer.php
$GLOBALS['footer-text'] = 'Sources of elements ...';


////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Movie successfully added';
$GLOBALS['admin-person-success'] = 'Person successfully added';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Add a movie';
$GLOBALS['movie-form-add-movie-title'] = 'Title';
$GLOBALS['movie-form-add-movie-image'] = 'Image';
$GLOBALS['movie-form-add-movie-score'] = 'Score';
$GLOBALS['update-form-link-title'] = 'Add a link';
$GLOBALS['update-form-link'] = 'Add link';
$GLOBALS['delete-form-link'] = 'Delete link';
$GLOBALS['update-movie-form-title'] = 'Choose a movie to edit';
$GLOBALS['update-movie-form-question'] = 'Edit this movie';
$GLOBALS['delete-movie-form'] = 'Delete this movie';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Enter movie title';
$GLOBALS['movie-form-add-movie-release-date'] = 'Release date';
$GLOBALS['movie-form-add-movie-duration'] = 'Duration';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Enter movie duration';
$GLOBALS['movie-form-add-movie-poster'] = 'Poster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Remove';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Enter movie synopsis';
$GLOBALS['movie-form-add-movie-trailer'] = 'Trailer';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Enter movie trailer';
$GLOBALS['movie-form-add-movie-tags'] = 'Tags';
$GLOBALS['movie-form-add-movie-new-tag'] = 'New tag';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Add tag';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Rating';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Enter movie rating';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'All ages';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'and older';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Directors list';
$GLOBALS['movie-form-add-movie-add-director'] = 'Add director';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Actors list';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Add actor';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Composers list';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Add composer';
$GLOBALS['movie-form-add-played'] = 'Played role';
$GLOBALS['movie-form-add-movie-seen'] = 'Seen';
$GLOBALS['movie-form-add-movie-add'] = 'Add';
$GLOBALS['movie-form-add-movie-cancel'] = 'Cancel';
$GLOBALS['movie-form-exception-adding'] = 'Error adding movie to database';
$GLOBALS['movie-form-exception-upload'] = 'Error uploading poster';
$GLOBALS['movie-form-exception-title'] = 'Movie title is required and must be between 3 and 50 characters';
$GLOBALS['movie-form-exception-release-date'] = 'Release date must be in YYYY-MM-DD format';
$GLOBALS['movie-form-exception-duration'] = 'Movie duration is required and must be a positive integer';
$GLOBALS['movie-form-exception-poster'] = 'Movie poster is required and must be in .jpg, .jpeg, or .png format';
$GLOBALS['movie-form-exception-synopsis'] = 'Movie synopsis is required and must be between 10 and 500 characters';
$GLOBALS['movie-form-exception-trailer'] = 'Movie trailer is required and must be a valid URL to a YouTube, Dailymotion, or Vimeo video';
$GLOBALS['movie-form-exception-tags'] = 'Movie must have at least one tag';
$GLOBALS['movie-form-exception-age-rating'] = 'Movie rating is required and must be a positive integer';
$GLOBALS['movie-form-exception-seen'] = 'Value of \'Seen\' must be true or false. Movie cannot be seen if it is not released';
$GLOBALS['movie-form-exception-actor-role'] = 'Role must be defined for each actor';

//update-tag-form.php
$GLOBALS['update-tag-form-title']='Edit tag';
$GLOBALS['update-tag-form-submit']='Edit';
$GLOBALS['update-tag-form-name']='Tag name';
$GLOBALS['update-tag-form-question']='Choose a tag to update';
$GLOBALS['delete-tag-form']='Delete tag';
$GLOBALS['tag-form-exception-name'] = 'Tag name must be between 3 and 50 characters.';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Add a person';
$GLOBALS['person-form-type'] = 'Person type';
$GLOBALS['update-person-form-title'] = 'Edit a person';
$GLOBALS['update-person-form-question'] = 'Choose a person to edit';
$GLOBALS['delete-person-form'] = 'Delete this person';
$GLOBALS['update-person-form-submit']= 'Edit';
$GLOBALS['person-form-add-person-first-name'] = 'First name';
$GLOBALS['person-form-add-person-last-name'] = 'Last name';
$GLOBALS['person-form-add-person-birth-date'] = 'Birth date';
$GLOBALS['person-form-add-person-death-date'] = 'Death date';
$GLOBALS['person-form-add-person-image'] = 'Image';
$GLOBALS['person-form-add-person-submit'] = 'Add';
$GLOBALS['person-form-exception-adding'] = 'Error adding person to database';
$GLOBALS['person-form-exception-first-name'] = 'Person\'s first name is required and must be between 3 and 50 characters';
$GLOBALS['person-form-exception-last-name'] = 'Person\'s last name is required and must be between 3 and 50 characters';
$GLOBALS['person-form-exception-birth-date'] = 'Person\'s birth date is required, must be in YYYY-MM-DD format, and must be a past date';
$GLOBALS['person-form-exception-death-date'] = 'Person\'s death date must be empty or a past date';
$GLOBALS['person-form-exception-image'] = 'Person\'s image is required and must be in .jpg, .jpeg, or .png format';
$GLOBALS['person-form-exception-upload'] = 'Error uploading image';

////////// ADVANCED SEARCH //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Advanced movie search';
$GLOBALS['advanced-search-movie-add-filter'] = 'Add filter';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Attribute';
$GLOBALS['advanced-search-movie-filter-value'] = 'Value';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Remove';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Choose...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Title';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Release date';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Duration';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Synopsis';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Trailer';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Tags';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Rating';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Director(s)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Actor(s)';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Composer(s)';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Seen';

////////// FAVORITES //////////
$GLOBALS['favorites-title']= 'Your favorites';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Movies';
$GLOBALS['all-movies-filter-by-tag'] = 'Filter by tag';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Peoples';

////////// HOME //////////
// home.php
$GLOBALS['home-discover-title'] = 'Movie discoveries';
$GLOBALS['random-home-title'] = 'Random movies';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Release date';
$GLOBALS['movie-time-duration'] = 'Duration';
$GLOBALS['movie-rating'] = 'Rating';
$GLOBALS['movie-note'] = 'Note';
$GLOBALS['movie-vu'] = 'Seen';
$GLOBALS['movie-minutes'] = 'minutes';
$GLOBALS['movie-rating-1'] = 'All ages';
$GLOBALS['movie-rating-2'] = 'and older';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Edit';
$GLOBALS['movie-save-vu'] = 'Save';
$GLOBALS['movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-directors'] = 'Director(s)';
$GLOBALS['movie-director'] = 'Director';
$GLOBALS['movie-composer'] = 'Composer';
$GLOBALS['movie-actors'] = 'Actor(s)';
$GLOBALS['movie-actor'] = 'Actor';
$GLOBALS['movie-composers'] = 'Composer(s)';
$GLOBALS['movie-error-1'] = 'No movie ID provided';
$GLOBALS['movie-error-2'] = 'No movie found with ID: ';

// EditableObject.php
$GLOBALS['movie-edit'] = 'Edit';
$GLOBALS['movie-save-changes'] = 'Save changes';
$GLOBALS['movie-cancel'] = 'Cancel';
$GLOBALS['movie-editable-new-title'] = 'New title';
$GLOBALS['movie-editable-new-release-date'] = 'New release date';
$GLOBALS['movie-editable-new-synopsis'] = 'New synopsis';
$GLOBALS['movie-editable-new-time-duration'] = 'New duration';
$GLOBALS['movie-editable-new-note'] = 'New note';
$GLOBALS['movie-editable-new-rating'] = 'New rating';
$GLOBALS['movie-editable-error-unknown-type'] = 'Error: unknown type';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'No person ID provided';
$GLOBALS['person-error-2'] = 'No person found with ID: ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Please log in';
$GLOBALS['login-user'] = 'Username';
$GLOBALS['login-password'] = 'Password';
$GLOBALS['login-submit'] = 'Login';
$GLOBALS['login-error'] = 'Incorrect username or password, please try again';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Database connection error: ';
$GLOBALS['pdo-execute-error'] = 'Error executing query: ';

// MovieDB.php
$GLOBALS['movie-db-already-exists'] = 'Movie already exists';

// PersonDB.php
$GLOBALS['person-db-already-exists'] = 'Person already exists';

// TagDB.php
$GLOBALS['tag-db-already-exists'] = 'Tag already exists';

////////// API //////////
// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'No tag provided';
$GLOBALS['api-add-tag-error-2'] = 'Error adding tag. Please make sure the tag does not already exist';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'Requested table is not valid. Valid tables are: movies, tag, and person';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'Attribute and/or value not set';
$GLOBALS['api-get-data-table-not-set'] = 'Table not set';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'No language provided';
$GLOBALS['api-get-localized-text-error-2'] = 'Text not found';
$GLOBALS['api-get-localized-text-error-3'] = 'No text provided';

// get-movies-by-tag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'Tag ID missing';

// language.php
$GLOBALS['api-language-error-1'] = 'No method provided';
$GLOBALS['api-language-error-2'] = 'Invalid method';
$GLOBALS['api-language-error-3'] = 'Invalid language';
$GLOBALS['api-language-error-4'] = 'Error changing language';

// set-seen-favorite.php
$GLOBALS['api-set-seen-error-1'] = 'No movie ID provided';
$GLOBALS['api-set-seen-error-2'] = 'No \'Seen\' parameter provided';
$GLOBALS['api-set-seen-success'] = '\'Seen\' attribute successfully updated';

