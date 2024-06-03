<?php
////////// EN //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'My movies';
$GLOBALS['template-light-theme'] = 'Light theme';
$GLOBALS['template-dark-theme'] = 'Dark theme';

// header.php
$GLOBALS['header-title'] = 'Home Of Movies';
$GLOBALS['header-home'] = 'Home';
$GLOBALS['header-movies'] = 'Movies';
$GLOBALS['header-peoples'] = 'Peoples';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-logout'] = 'Logout';
$GLOBALS['header-theme'] = 'Theme';
$GLOBALS['header-language-dropdown-default'] = 'Choose language';

// footer.php
$GLOBALS['footer-text'] = 'Element\'s sources ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Movie successfully added';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Add a movie';
$GLOBALS['movie-form-add-movie-title'] = 'Title';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Enter the movie title';
$GLOBALS['movie-form-add-movie-release-date'] = 'Release date';
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
$GLOBALS['movie-form-add-movie-age-rating'] = 'Age rating';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Enter the movie age rating';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'All public';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'years old and over';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Directors list';
$GLOBALS['movie-form-add-movie-add-director'] = 'Add a director';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Actors list';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Add an actor';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Composers list';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Add a composer';
$GLOBALS['movie-form-add-movie-seen'] = 'Seen';
$GLOBALS['movie-form-add-movie-add'] = 'Add';
$GLOBALS['movie-form-add-movie-cancel'] = 'Cancel';
$GLOBALS['movie-form-exception-adding'] = 'Error adding the movie to the database';
$GLOBALS['movie-form-exception-upload'] = 'Error uploading the poster';
$GLOBALS['movie-form-exception-title'] = 'The movie title is required and must contain between 3 and 50 characters';
$GLOBALS['movie-form-exception-release-date'] = 'The movie release date is required and must be at the format YYYY-MM-DD';
$GLOBALS['movie-form-exception-duration'] = 'The movie duration is required and must be a positive integer';
$GLOBALS['movie-form-exception-poster'] = 'The movie poster is required and must be at the format .jpg, .jpeg, or .png';
$GLOBALS['movie-form-exception-synopsis'] = 'The movie synopsis is required and must contain between 10 and 500 characters';
$GLOBALS['movie-form-exception-trailer'] = 'The movie trailer is required and must be a valid URL from Youtube, Dailymotion, or Vimeo';
$GLOBALS['movie-form-exception-tags'] = 'The movie must have at least one tag';
$GLOBALS['movie-form-exception-age-rating'] = 'The movie age rating is required and must be a positive integer';
$GLOBALS['movie-form-exception-seen'] = 'The movie seen must be true or false. Movie can\'t be seen if it\'s not released yet';
$GLOBALS['movie-form-exception-actor-role'] = 'The role must be set for each actor';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Movies';
$GLOBALS['all-movies-filter-by-tag'] = 'Filter by tag';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Peoples';

////////// HOME //////////
// home.php
$GLOBALS['home-most-popular-title'] = 'Most popular movies';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-directors'] = 'Director(s)';
$GLOBALS['movie-actors'] = 'Actor(s)';
$GLOBALS['movie-composers'] = 'Composer(s)';
$GLOBALS['movie-error-1'] = 'No movie ID provided';
$GLOBALS['movie-error-2'] = 'No movie found with ID : ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'No person ID provided';
$GLOBALS['person-error-2'] = 'No person found with ID : ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Please login';
$GLOBALS['login-user'] = 'Username';
$GLOBALS['login-password'] = 'Password';
$GLOBALS['login-submit'] = 'Login';
$GLOBALS['login-error'] = 'Username or password incorrect, please try again';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Error connecting to the database : ';
$GLOBALS['pdo-execute-error'] = 'Error executing the query : ';

////////// AJAX //////////
// get-data.php
$GLOBALS['ajax-get-data-table-not-valid'] = 'The requested table is not valid. Valid tables are : movies, tag, and person';
$GLOBALS['ajax-get-data-attribute-value-not-set'] = 'The attribute and/or the value are not set';
$GLOBALS['ajax-get-data-table-not-set'] = 'The table is not set';