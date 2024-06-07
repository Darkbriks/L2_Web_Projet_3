<?php
////////// EN //////////

////////// GLOBAL EXPRESSIONS //////////
$GLOBALS['still-alive'] = 'Still alive';
$GLOBALS['edit'] = 'Edit';
$GLOBALS['save-changes'] = 'Save changes';
$GLOBALS['cancel'] = 'Cancel';
$GLOBALS['error-unknown-type'] = 'Error: unknown type';

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'My Movies';
$GLOBALS['template-light-theme'] = 'Light Theme';
$GLOBALS['template-dark-theme'] = 'Dark Theme';

// header.php
$GLOBALS['header-title'] = 'Home Movies';
$GLOBALS['header-home'] = 'Home';
$GLOBALS['header-movies'] = 'Movies';
$GLOBALS['header-peoples'] = 'People';
$GLOBALS['header-favorites'] = 'Favorites';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-advanced-search'] = 'Advanced Search';
$GLOBALS['header-search'] = 'Search';
$GLOBALS['header-logout'] = 'Logout';
$GLOBALS['header-login'] = 'Login';
$GLOBALS['header-theme'] = 'Theme';
$GLOBALS['header-language-dropdown-default'] = 'Choose Language';

// footer.php
$GLOBALS['footer-text'] = 'Element sources...';

////////// ADMIN //////////
// admin.php
//add
$GLOBALS['admin-movie-success'] = 'Movie successfully added';
$GLOBALS['admin-person-success'] = 'Person successfully added';
//update
$GLOBALS['admin-movie-update-success'] = 'Movie successfully updated';
$GLOBALS['admin-person-update-success'] = 'Person successfully updated';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Add a Movie';
$GLOBALS['movie-form-add-movie-title'] = 'Title';
$GLOBALS['movie-form-add-movie-image'] = 'Image';
$GLOBALS['movie-form-add-movie-score'] = 'Score';
$GLOBALS['update-form-link-title'] = 'Add a link';
$GLOBALS['update-form-link'] = 'Add link';
$GLOBALS['delete-form-link'] = 'Delete link';
$GLOBALS['update-movie-form-title'] = 'Choose a movie to edit';
$GLOBALS['update-movie-form-question'] = 'Edit this movie';
$GLOBALS['delete-movie-form'] = 'Delete this movie';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Enter the movie title';
$GLOBALS['movie-form-add-movie-release-date'] = 'Release Date';
$GLOBALS['movie-form-add-movie-duration'] = 'Duration';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Enter the movie duration';
$GLOBALS['movie-form-add-movie-poster'] = 'Poster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Remove';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Enter the movie synopsis';
$GLOBALS['movie-form-add-movie-trailer'] = 'Trailer';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Enter the movie trailer';
$GLOBALS['movie-form-add-movie-tags'] = 'Tags';
$GLOBALS['movie-form-add-movie-new-tag'] = 'New tag';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Add tag';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Age Rating';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Enter the movie age rating';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'All ages';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'years and older';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Directors List';
$GLOBALS['movie-form-add-movie-add-director'] = 'Add director';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Actors List';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Add actor';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Composers List';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Add composer';
$GLOBALS['movie-form-add-played'] = 'Role played';
$GLOBALS['movie-form-add-movie-seen'] = 'Seen';
$GLOBALS['movie-form-add-movie-add'] = 'Add';
$GLOBALS['movie-form-add-movie-cancel'] = 'Cancel';
$GLOBALS['movie-form-exception-adding'] = 'Error adding movie to the database';
$GLOBALS['movie-form-exception-upload'] = 'Error uploading the poster';
$GLOBALS['movie-form-exception-title'] = 'The movie title is required and must be between 3 and 50 characters';
$GLOBALS['movie-form-exception-release-date'] = 'The release date must be in YYYY-MM-DD format';
$GLOBALS['movie-form-exception-duration'] = 'The movie duration is required and must be a positive integer';
$GLOBALS['movie-form-exception-poster'] = 'The movie poster is required and must be in .jpg, .jpeg, or .png format';
$GLOBALS['movie-form-exception-synopsis'] = 'The movie synopsis is required and must be between 10 and 500 characters';
$GLOBALS['movie-form-exception-trailer'] = 'The movie trailer is required and must be a valid URL to a YouTube, Dailymotion, or Vimeo video';
$GLOBALS['movie-form-exception-tags'] = 'The movie must have at least one tag';
$GLOBALS['movie-form-exception-age-rating'] = 'The movie age rating is required and must be a positive integer';
$GLOBALS['movie-form-exception-seen'] = 'The "Seen" value must be true or false. The movie cannot be marked as seen if it is not released';
$GLOBALS['movie-form-exception-actor-role'] = 'The role must be defined for each actor';

//update-tag-form.php
$GLOBALS['update-tag-form-title']='Edit a tag';
$GLOBALS['update-tag-form-submit']='Edit';
$GLOBALS['update-tag-form-name']='Tag name';
$GLOBALS['update-tag-form-question']='Choose a tag to update';
$GLOBALS['delete-tag-form']='Delete tag';
$GLOBALS['tag-form-exception-name'] = 'The tag name must be between 3 and 50 characters';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Add a Person';
$GLOBALS['person-form-type'] = 'Person type';
$GLOBALS['update-person-form-title'] = 'Edit a Person';
$GLOBALS['update-person-form-question'] = 'Choose a person to edit';
$GLOBALS['delete-person-form'] = 'Delete this person';
$GLOBALS['update-person-form-submit']= 'Edit';
$GLOBALS['person-form-add-person-first-name'] = 'First Name';
$GLOBALS['person-form-add-person-last-name'] = 'Last Name';
$GLOBALS['person-form-add-person-birth-date'] = 'Birth Date';
$GLOBALS['person-form-add-person-death-date'] = 'Death Date';
$GLOBALS['person-form-add-person-image'] = 'Image';
$GLOBALS['person-form-add-person-submit'] = 'Add';
$GLOBALS['person-form-exception-adding'] = 'Error adding person to the database';
$GLOBALS['person-form-exception-first-name'] = 'The person\'s first name is required and must be between 3 and 50 characters';
$GLOBALS['person-form-exception-last-name'] = 'The person\'s last name is required and must be between 3 and 50 characters';
$GLOBALS['person-form-exception-birth-date'] = 'The person\'s birth date is required, must be in YYYY-MM-DD format and must be a past date';
$GLOBALS['person-form-exception-death-date'] = 'The person\'s death date must be empty or a past date';
$GLOBALS['person-form-exception-image'] = 'The person\'s image is required and must be in .jpg, .jpeg, or .png format';
$GLOBALS['person-form-exception-upload'] = 'Error uploading the image';

////////// ADVANCED SEARCH //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Advanced Movie Search';
$GLOBALS['advanced-search-movie-add-filter'] = 'Add a filter';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Attribute';
$GLOBALS['advanced-search-movie-filter-value'] = 'Value';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Remove';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Choose...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Title';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Release Date';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Duration';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Synopsis';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Trailer';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Tags';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Age Rating';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Director(s)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Actor(s)';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Composer(s)';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Seen';
$GLOBALS['advanced-search-movie-filter-value-like'] = 'Like';
$GLOBALS['advanced-search-movie-filter-value-not-like'] = 'Not like';
$GLOBALS['advanced-search-movie-filter-value-equal'] = 'Equal';
$GLOBALS['advanced-search-movie-filter-value-not-equal'] = 'Not equal';
$GLOBALS['advanced-search-movie-filter-value-greater-than'] = 'Greater than';
$GLOBALS['advanced-search-movie-filter-value-less-than'] = 'Less than';
$GLOBALS['advanced-search-movie-filter-value-seen'] = 'Seen';
$GLOBALS['advanced-search-movie-filter-value-not-seen'] = 'Not seen';
$GLOBALS['advanced-search-movie-filter-value-and'] = 'AND';
$GLOBALS['advanced-search-movie-filter-value-OR'] = 'OR';

// advanced-search-person.php
$GLOBALS['advanced-search-person-modal-title'] = 'Advanced Person Search';
$GLOBALS['advanced-search-person-add-filter'] = 'Add a filter';
$GLOBALS['advanced-search-person-filter-attribute'] = 'Attribute';
$GLOBALS['advanced-search-person-filter-value'] = 'Value';
$GLOBALS['advanced-search-person-filter-remove'] = 'Remove';
$GLOBALS['advanced-search-person-filter-attribute-choose'] = 'Choose...';
$GLOBALS['advanced-search-person-filter-attribute-first-name'] = 'First Name';
$GLOBALS['advanced-search-person-filter-attribute-last-name'] = 'Last Name';
$GLOBALS['advanced-search-person-filter-attribute-birth-date'] = 'Birth Date';
$GLOBALS['advanced-search-person-filter-attribute-death-date'] = 'Death Date';
$GLOBALS['advanced-search-person-filter-value-like'] = 'Like';
$GLOBALS['advanced-search-person-filter-value-not-like'] = 'Not like';
$GLOBALS['advanced-search-person-filter-value-equal'] = 'Equal';
$GLOBALS['advanced-search-person-filter-value-not-equal'] = 'Not equal';
$GLOBALS['advanced-search-person-filter-value-greater-than'] = 'Greater than';
$GLOBALS['advanced-search-person-filter-value-less-than'] = 'Less than';
$GLOBALS['advanced-search-person-filter-value-and'] = 'AND';
$GLOBALS['advanced-search-person-filter-value-OR'] = 'OR';

////////// FAVORITES //////////
$GLOBALS['favorites-title'] = 'Your Favorites';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Movies';
$GLOBALS['all-movies-filter-by-tag'] = 'Filter by Tag';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'People';

////////// HOME //////////
// home.php
$GLOBALS['home-discover-title'] = 'Movie Discoveries';
$GLOBALS['random-home-title'] = 'Random Movies';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Release Date';
$GLOBALS['movie-time-duration'] = 'Duration';
$GLOBALS['movie-rating'] = 'Rating';
$GLOBALS['movie-note'] = 'Note';
$GLOBALS['movie-vu'] = 'Seen';
$GLOBALS['movie-favorite'] = 'Favorite';
$GLOBALS['movie-minutes'] = 'minutes';
$GLOBALS['movie-rating-1'] = 'All Ages';
$GLOBALS['movie-rating-2'] = 'Years and Above';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Edit';
$GLOBALS['movie-save-vu'] = 'Save';
$GLOBALS['movie-synopsis'] = 'Synopsis';
$GLOBALS['movie-directors'] = 'Directors';
$GLOBALS['movie-director'] = 'Director';
$GLOBALS['movie-composer'] = 'Composer';
$GLOBALS['movie-actors'] = 'Actors';
$GLOBALS['movie-actor'] = 'Actor';
$GLOBALS['movie-composers'] = 'Composers';
$GLOBALS['movie-error-1'] = 'No movie ID provided';
$GLOBALS['movie-error-2'] = 'No movie found with ID: ';

// EditableMovie.php
$GLOBALS['movie-edit'] = 'Edit';
$GLOBALS['movie-save-changes'] = 'Save Changes';
$GLOBALS['movie-cancel'] = 'Cancel';
$GLOBALS['movie-editable-new-title'] = 'New Title';
$GLOBALS['movie-editable-new-release-date'] = 'New Release Date';
$GLOBALS['movie-editable-new-synopsis'] = 'New Synopsis';
$GLOBALS['movie-editable-new-time-duration'] = 'New Duration';
$GLOBALS['movie-editable-new-note'] = 'New Note';
$GLOBALS['movie-editable-new-rating'] = 'New Rating';
$GLOBALS['movie-editable-error-unknown-type'] = 'Error: Unknown Type';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'No person ID provided';
$GLOBALS['person-error-2'] = 'No person found with ID: ';
$GLOBALS['person-first-name'] = 'First Name';
$GLOBALS['person-last-name'] = 'Last Name';
$GLOBALS['person-birth-date'] = 'Birth Date';
$GLOBALS['person-death-date'] = 'Death Date';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Please Login';
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
$GLOBALS['api-add-tag-error-2'] = 'Error adding tag. Please ensure the tag does not already exist';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'Requested table is not valid. Valid tables are: movies, tag, and person';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'Attribute and/or value not set';
$GLOBALS['api-get-data-table-not-set'] = 'Table not set';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'No language provided';
$GLOBALS['api-get-localized-text-error-2'] = 'Text not found';
$GLOBALS['api-get-localized-text-error-3'] = 'No text provided';

// get-movies-by-tag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'Missing tag ID';

// language.php
$GLOBALS['api-language-error-1'] = 'No method provided';
$GLOBALS['api-language-error-2'] = 'Invalid method';
$GLOBALS['api-language-error-3'] = 'Invalid language';
$GLOBALS['api-language-error-4'] = 'Error changing language';

// set-seen-favorite.php
$GLOBALS['api-set-seen-error-1'] = 'No movie ID provided';
$GLOBALS['api-set-seen-error-2'] = 'No "Seen" parameter provided';
$GLOBALS['api-set-seen-success'] = '"Seen" attribute updated successfully';