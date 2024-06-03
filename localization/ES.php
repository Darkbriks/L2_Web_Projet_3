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
// get-data.php
$GLOBALS['ajax-get-data-table-not-valid'] = 'La tabla solicitada no es válida. Las tablas válidas son: movies, tag y person';
$GLOBALS['ajax-get-data-attribute-value-not-set'] = 'El atributo y/o el valor no están establecidos';
$GLOBALS['ajax-get-data-table-not-set'] = 'La tabla no está establecida';
// addTag.php
$GLOBALS['tag-add-success'] = 'Etiqueta agregada exitosamente';
$GLOBALS['tag-add-failure'] = 'La etiqueta ya existe';
// get-localized-text.php
$GLOBALS['error-no-language'] = 'No se ha proporcionado ningún idioma';
$GLOBALS['error-text-not-found'] = 'Texto no encontrado';
$GLOBALS['error-no-text'] = 'No se ha proporcionado ningún texto';
// getAllPeoples.php
$GLOBALS['person-fetch-success'] = 'Personas recuperadas exitosamente';
$GLOBALS['person-fetch-failure'] = 'Error al recuperar personas';
// getMoviesByTag.php
$GLOBALS['error-tag-id-missing'] = 'Falta el ID del tag';
// language.php
$GLOBALS['error-no-method'] = 'No se ha proporcionado ningún método';
$GLOBALS['error-invalid-method'] = 'Método no válido';
$GLOBALS['error-no-language'] = 'No se ha proporcionado ningún idioma';
$GLOBALS['error-cookie-not-set'] = 'No se pudo establecer la cookie';
// movieFormAddPerson.php
$GLOBALS['error-person-not-found'] = 'Persona no encontrada';

// allMovies.php
$GLOBALS['filter-by-tag'] = 'Filtrar por etiqueta';
$GLOBALS['all'] = 'Todos';
$GLOBALS['movies'] = 'PELÍCULAS';

// allPeople.php
$GLOBALS['peoples'] = 'PERSONAS';