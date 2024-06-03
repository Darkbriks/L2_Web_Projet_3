<?php
////////// ES //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'Mis películas';
$GLOBALS['template-light-theme'] = 'Tema claro';
$GLOBALS['template-dark-theme'] = 'Tema oscuro';

// header.php
$GLOBALS['header-title'] = 'Hogar de las Películas';
$GLOBALS['header-home'] = 'Inicio';
$GLOBALS['header-movies'] = 'Películas';
$GLOBALS['header-peoples'] = 'Personas';
$GLOBALS['header-admin'] = 'Admin';
$GLOBALS['header-search'] = 'Buscar';
$GLOBALS['header-logout'] = 'Cerrar sesión';
$GLOBALS['header-theme'] = 'Tema';
$GLOBALS['header-language-dropdown-default'] = 'Elegir idioma';

// footer.php
$GLOBALS['footer-text'] = 'Fuentes de los elementos ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Película agregada con éxito';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Agregar una película';
$GLOBALS['movie-form-add-movie-title'] = 'Título';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Ingrese el título de la película';
$GLOBALS['movie-form-add-movie-release-date'] = 'Fecha de lanzamiento';
$GLOBALS['movie-form-add-movie-duration'] = 'Duración';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Ingrese la duración de la película';
$GLOBALS['movie-form-add-movie-poster'] = 'Póster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Eliminar';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Sinopsis';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Ingrese la sinopsis de la película';
$GLOBALS['movie-form-add-movie-trailer'] = 'Tráiler';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Ingrese el tráiler de la película';
$GLOBALS['movie-form-add-movie-tags'] = 'Etiquetas';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Nueva etiqueta';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Agregar etiqueta';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Clasificación por edad';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Ingrese la clasificación por edad de la película';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Para todo público';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'años y más';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Lista de directores';
$GLOBALS['movie-form-add-movie-add-director'] = 'Agregar un director';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Lista de actores';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Agregar un actor';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Lista de compositores';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Agregar un compositor';
$GLOBALS['movie-form-add-movie-seen'] = 'Visto';
$GLOBALS['movie-form-add-movie-add'] = 'Agregar';
$GLOBALS['movie-form-add-movie-cancel'] = 'Cancelar';
$GLOBALS['movie-form-exception-adding'] = 'Error al agregar la película a la base de datos';
$GLOBALS['movie-form-exception-upload'] = 'Error al subir el póster';
$GLOBALS['movie-form-exception-title'] = 'El título de la película es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['movie-form-exception-release-date'] = 'La fecha de lanzamiento de la película es obligatoria y debe estar en el formato AAAA-MM-DD';
$GLOBALS['movie-form-exception-duration'] = 'La duración de la película es obligatoria y debe ser un número entero positivo';
$GLOBALS['movie-form-exception-poster'] = 'El póster de la película es obligatorio y debe estar en formato .jpg, .jpeg o .png';
$GLOBALS['movie-form-exception-synopsis'] = 'La sinopsis de la película es obligatoria y debe contener entre 10 y 500 caracteres';
$GLOBALS['movie-form-exception-trailer'] = 'El tráiler de la película es obligatorio y debe ser una URL válida de Youtube, Dailymotion o Vimeo';
$GLOBALS['movie-form-exception-tags'] = 'La película debe tener al menos una etiqueta';
$GLOBALS['movie-form-exception-age-rating'] = 'La clasificación por edad de la película es obligatoria y debe ser un número entero positivo';
$GLOBALS['movie-form-exception-seen'] = 'El estado de la película vista debe ser verdadero o falso. La película no puede ser vista si aún no se ha estrenado';
$GLOBALS['movie-form-exception-actor-role'] = 'El papel debe ser establecido para cada actor';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Agregar una persona';
$GLOBALS['person-form-add-person-first-name'] = 'Nombre';
$GLOBALS['person-form-add-person-last-name'] = 'Apellido';
$GLOBALS['person-form-add-person-birth-date'] = 'Fecha de nacimiento';
$GLOBALS['person-form-add-person-death-date'] = 'Fecha de defunción';
$GLOBALS['person-form-add-person-image'] = 'Imagen';
$GLOBALS['person-form-add-person-submit'] = 'Agregar';
$GLOBALS['person-form-exception-adding'] = 'Error al agregar la persona a la base de datos';
$GLOBALS['person-form-exception-first-name'] = 'El nombre de la persona es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['person-form-exception-last-name'] = 'El apellido de la persona es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['person-form-exception-birth-date'] = 'La fecha de nacimiento de la persona es obligatoria y debe estar en el formato AAAA-MM-DD';
$GLOBALS['person-form-exception-death-date'] = 'La fecha de defunción de la persona debe estar en el formato AAAA-MM-DD';
$GLOBALS['person-form-exception-image'] = 'Error al subir la imagen';
$GLOBALS['person-form-exception-upload'] = 'Error al subir la imagen';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Películas';
$GLOBALS['all-movies-filter-by-tag'] = 'Filtrar por etiqueta';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Personas';

////////// HOME //////////
// home.php
$GLOBALS['home-most-popular-title'] = 'Películas más populares';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Fecha de lanzamiento';
$GLOBALS['movie-time-duration'] = 'Duración';
$GLOBALS['movie-rating'] = 'Clasificación';
$GLOBALS['movie-note'] = 'Nota';
$GLOBALS['movie-vu'] = 'Visto';
$GLOBALS['movie-synopsis'] = 'Sinopsis';
$GLOBALS['movie-directors'] = 'Director(es)';
$GLOBALS['movie-actors'] = 'Actor(es)';
$GLOBALS['movie-composers'] = 'Compositor(es)';
$GLOBALS['movie-error-1'] = 'No se proporcionó ningún ID de película';
$GLOBALS['movie-error-2'] = 'No se encontró ninguna película con el ID : ';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'No se proporcionó ningún ID de persona';
$GLOBALS['person-error-2'] = 'No se encontró ninguna persona con el ID : ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Por favor, inicie sesión';
$GLOBALS['login-user'] = 'Nombre de usuario';
$GLOBALS['login-password'] = 'Contraseña';
$GLOBALS['login-submit'] = 'Iniciar sesión';
$GLOBALS['login-error'] = 'Nombre de usuario o contraseña incorrectos, por favor intente nuevamente';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Error al conectar con la base de datos: ';
$GLOBALS['pdo-execute-error'] = 'Error al ejecutar la consulta: ';

////////// AJAX //////////
// add-tag.php
$GLOBALS['ajax-add-tag-error-1'] = 'No se proporcionó ninguna etiqueta';
$GLOBALS['ajax-add-tag-error-2'] = 'Error al agregar la etiqueta a la base de datos';

// get-data.php
$GLOBALS['ajax-get-data-table-not-valid'] = 'La tabla solicitada no es válida. Las tablas válidas son: movies, tag y person';
$GLOBALS['ajax-get-data-attribute-value-not-set'] = 'Atributo y/o valor no establecido';
$GLOBALS['ajax-get-data-table-not-set'] = 'Tabla no establecida';

// get-localized-text.php
$GLOBALS['ajax-get-localized-text-error-1'] = 'No se proporcionó ningún idioma';
$GLOBALS['ajax-get-localized-text-error-2'] = 'No se proporcionó ningún texto';
$GLOBALS['ajax-get-localized-text-error-3'] = 'Texto no encontrado';

// getMoviesByTag.php
$GLOBALS['ajax-get-movies-by-tag-error-1'] = 'ID de etiqueta faltante';

// language.php
$GLOBALS['ajax-language-error-1'] = 'No se proporcionó ningún método';
$GLOBALS['ajax-language-error-2'] = 'Idioma no válido';
$GLOBALS['ajax-language-error-3'] = 'Error al cambiar el idioma';
$GLOBALS['ajax-language-error-4'] = 'Idioma no establecido';