<?php
////////// ES //////////

////////// TEMPLATE //////////
// template.php
$GLOBALS['template-title'] = 'Mis películas';
$GLOBALS['template-light-theme'] = 'Tema claro';
$GLOBALS['template-dark-theme'] = 'Tema oscuro';

// header.php
$GLOBALS['header-title'] = 'Página principal de películas';
$GLOBALS['header-home'] = 'Inicio';
$GLOBALS['header-movies'] = 'Películas';
$GLOBALS['header-peoples'] = 'Personas';
$GLOBALS['header-favorites'] = 'Favoritos';
$GLOBALS['header-admin'] = 'Administración';
$GLOBALS['header-advanced-search'] = 'Búsqueda avanzada';
$GLOBALS['header-search'] = 'Buscar';
$GLOBALS['header-logout'] = 'Cerrar sesión';
$GLOBALS['header-login']='Iniciar sesión';
$GLOBALS['header-theme'] = 'Tema';
$GLOBALS['header-language-dropdown-default'] = 'Seleccionar idioma';

// footer.php
$GLOBALS['footer-text'] = 'Fuentes de los elementos ...';

////////// ADMIN //////////
// admin.php
$GLOBALS['admin-movie-success'] = 'Película añadida exitosamente';
$GLOBALS['admin-person-success'] = 'Persona añadida exitosamente';

// MovieForm.php
$GLOBALS['movie-form-title'] = 'Añadir película';
$GLOBALS['movie-form-add-movie-title'] = 'Título';
$GLOBALS['movie-form-add-movie-image'] = 'Imagen';
$GLOBALS['movie-form-add-movie-score'] = 'Puntuación';
$GLOBALS['update-form-link-title'] = 'Añadir enlace';
$GLOBALS['update-form-link'] = 'Añadir enlace';
$GLOBALS['delete-form-link'] = 'Eliminar enlace';
$GLOBALS['update-movie-form-title'] = 'Elegir película para editar';
$GLOBALS['update-movie-form-question'] = 'Editar esta película';
$GLOBALS['delete-movie-form'] = 'Eliminar esta película';
$GLOBALS['movie-form-add-movie-title-placeholder'] = 'Introducir título de la película';
$GLOBALS['movie-form-add-movie-release-date'] = 'Fecha de estreno';
$GLOBALS['movie-form-add-movie-duration'] = 'Duración';
$GLOBALS['movie-form-add-movie-duration-placeholder'] = 'Introducir duración de la película';
$GLOBALS['movie-form-add-movie-poster'] = 'Póster';
$GLOBALS['movie-form-add-movie-remove-poster'] = 'Eliminar';
$GLOBALS['movie-form-add-movie-synopsis'] = 'Sinopsis';
$GLOBALS['movie-form-add-movie-synopsis-placeholder'] = 'Introducir sinopsis de la película';
$GLOBALS['movie-form-add-movie-trailer'] = 'Tráiler';
$GLOBALS['movie-form-add-movie-trailer-placeholder'] = 'Introducir tráiler de la película';
$GLOBALS['movie-form-add-movie-tags'] = 'Etiquetas';
$GLOBALS['movie-form-add-movie-new-tag'] = 'Nueva etiqueta';
$GLOBALS['movie-form-add-movie-add-tag'] = 'Añadir etiqueta';
$GLOBALS['movie-form-add-movie-age-rating'] = 'Clasificación';
$GLOBALS['movie-form-add-movie-age-rating-placeholder'] = 'Introducir clasificación de la película';
$GLOBALS['movie-form-add-movie-age-rating-all'] = 'Todos los públicos';
$GLOBALS['movie-form-add-movie-age-rating-number'] = 'años y más';
$GLOBALS['movie-form-add-movie-directors-list'] = 'Lista de directores';
$GLOBALS['movie-form-add-movie-add-director'] = 'Añadir director';
$GLOBALS['movie-form-add-movie-actors-list'] = 'Lista de actores';
$GLOBALS['movie-form-add-movie-add-actor'] = 'Añadir actor';
$GLOBALS['movie-form-add-movie-composers-list'] = 'Lista de compositores';
$GLOBALS['movie-form-add-movie-add-composer'] = 'Añadir compositor';
$GLOBALS['movie-form-add-played'] = 'Papel interpretado';
$GLOBALS['movie-form-add-played'] = 'Papel interpretado';
$GLOBALS['movie-form-add-movie-seen'] = 'Visto';
$GLOBALS['movie-form-add-movie-add'] = 'Añadir';
$GLOBALS['movie-form-add-movie-cancel'] = 'Cancelar';
$GLOBALS['movie-form-exception-adding'] = 'Error al añadir la película en la base de datos';
$GLOBALS['movie-form-exception-upload'] = 'Error al cargar el póster';
$GLOBALS['movie-form-exception-title'] = 'El título de la película es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['movie-form-exception-release-date'] = 'La fecha de estreno debe tener el formato AAAA-MM-DD';
$GLOBALS['movie-form-exception-duration'] = 'La duración de la película es obligatoria y debe ser un número entero positivo';
$GLOBALS['movie-form-exception-poster'] = 'El póster de la película es obligatorio y debe estar en formato .jpg, .jpeg o .png';
$GLOBALS['movie-form-exception-synopsis'] = 'La sinopsis de la película es obligatoria y debe contener entre 10 y 500 caracteres';
$GLOBALS['movie-form-exception-trailer'] = 'El tráiler de la película es obligatorio y debe ser una URL válida hacia un vídeo de YouTube, Dailymotion o Vimeo';
$GLOBALS['movie-form-exception-tags'] = 'La película debe tener al menos una etiqueta';
$GLOBALS['movie-form-exception-age-rating'] = 'La clasificación de la película es obligatoria y debe ser un número entero positivo';
$GLOBALS['movie-form-exception-seen'] = 'El valor de \'Visto\' debe ser verdadero o falso. La película no puede haber sido vista si no ha sido estrenada';
$GLOBALS['movie-form-exception-actor-role'] = 'El papel debe estar definido para cada actor';

//update-tag-form.php
$GLOBALS['update-tag-form-title']='Editar etiqueta';
$GLOBALS['update-tag-form-submit']='Editar';
$GLOBALS['update-tag-form-name']='Nombre de la etiqueta';
$GLOBALS['update-tag-form-question']='Elegir etiqueta para actualizar ';
$GLOBALS['delete-tag-form']='Eliminar etiqueta';
$GLOBALS['tag-form-exception-name'] = 'El nombre de la etiqueta debe contener entre 3 y 50 caracteres.';

// PersonForm.php
$GLOBALS['person-form-title'] = 'Añadir persona';
$GLOBALS['person-form-type'] = 'Tipo de persona';
$GLOBALS['update-person-form-title'] = 'Editar persona';
$GLOBALS['update-person-form-question'] = 'Elegir persona para editar';
$GLOBALS['delete-person-form'] = 'Eliminar esta persona';
$GLOBALS['update-person-form-submit']= 'Editar';
$GLOBALS['person-form-add-person-first-name'] = 'Nombre';
$GLOBALS['person-form-add-person-last-name'] = 'Apellido';
$GLOBALS['person-form-add-person-birth-date'] = 'Fecha de nacimiento';
$GLOBALS['person-form-add-person-death-date'] = 'Fecha de fallecimiento';
$GLOBALS['person-form-add-person-image'] = 'Imagen';
$GLOBALS['person-form-add-person-submit'] = 'Añadir';
$GLOBALS['person-form-exception-adding'] = 'Error al añadir la persona en la base de datos';
$GLOBALS['person-form-exception-first-name'] = 'El nombre de la persona es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['person-form-exception-last-name'] = 'El apellido de la persona es obligatorio y debe contener entre 3 y 50 caracteres';
$GLOBALS['person-form-exception-birth-date'] = 'La fecha de nacimiento de la persona es obligatoria, debe tener el formato AAAA-MM-DD y debe ser una fecha pasada';
$GLOBALS['person-form-exception-death-date'] = 'La fecha de fallecimiento de la persona debe estar vacía o ser una fecha pasada';
$GLOBALS['person-form-exception-image'] = 'La imagen de la persona es obligatoria y debe estar en formato .jpg, .jpeg o .png';
$GLOBALS['person-form-exception-upload'] = 'Error al cargar la imagen';

////////// ADVANCED SEARCH //////////
// advanced-search-movie.php
$GLOBALS['advanced-search-movie-modal-title'] = 'Búsqueda avanzada de películas';
$GLOBALS['advanced-search-movie-add-filter'] = 'Añadir filtro';
$GLOBALS['advanced-search-movie-filter-attribute'] = 'Atributo';
$GLOBALS['advanced-search-movie-filter-value'] = 'Valor';
$GLOBALS['advanced-search-movie-filter-remove'] = 'Eliminar';
$GLOBALS['advanced-search-movie-filter-attribute-choose'] = 'Seleccionar...';
$GLOBALS['advanced-search-movie-filter-attribute-title'] = 'Título';
$GLOBALS['advanced-search-movie-filter-attribute-release-date'] = 'Fecha de estreno';
$GLOBALS['advanced-search-movie-filter-attribute-duration'] = 'Duración';
$GLOBALS['advanced-search-movie-filter-attribute-synopsis'] = 'Sinopsis';
$GLOBALS['advanced-search-movie-filter-attribute-trailer'] = 'Tráiler';
$GLOBALS['advanced-search-movie-filter-attribute-tags'] = 'Etiquetas';
$GLOBALS['advanced-search-movie-filter-attribute-age-rating'] = 'Clasificación';
$GLOBALS['advanced-search-movie-filter-attribute-directors'] = 'Director(es)';
$GLOBALS['advanced-search-movie-filter-attribute-actors'] = 'Actor(es)';
$GLOBALS['advanced-search-movie-filter-attribute-composers'] = 'Compositor(es)';
$GLOBALS['advanced-search-movie-filter-attribute-seen'] = 'Visto';

////////// FAVORITES //////////
$GLOBALS['favorites-title']= 'Tus favoritos';

////////// ALL MOVIES //////////
// allMovies.php
$GLOBALS['all-movies-title'] = 'Películas';
$GLOBALS['all-movies-filter-by-tag'] = 'Filtrar por etiqueta';

////////// ALL PEOPLES //////////
// allPeoples.php
$GLOBALS['all-peoples-title'] = 'Personas';

////////// HOME //////////
// home.php
$GLOBALS['home-discover-title'] = 'Descubre películas';
$GLOBALS['random-home-title'] = 'Películas aleatorias';

////////// MOVIE //////////
// movie.php
$GLOBALS['movie-release-date'] = 'Fecha de estreno';
$GLOBALS['movie-time-duration'] = 'Duración';
$GLOBALS['movie-rating'] = 'Clasificación';
$GLOBALS['movie-note'] = 'Nota';
$GLOBALS['movie-vu'] = 'Visto';
$GLOBALS['movie-minutes'] = 'minutos';
$GLOBALS['movie-rating-1'] = 'Todos los públicos';
$GLOBALS['movie-rating-2'] = 'años y más';
$GLOBALS['movie-max-note'] = '/20';
$GLOBALS['movie-edit-vu'] = 'Editar';
$GLOBALS['movie-save-vu'] = 'Guardar';
$GLOBALS['movie-synopsis'] = 'Sinopsis';
$GLOBALS['movie-directors'] = 'Director(es)';
$GLOBALS['movie-director'] = 'Director';
$GLOBALS['movie-composer'] = 'Compositor';
$GLOBALS['movie-actors'] = 'Actor(es)';
$GLOBALS['movie-actor'] = 'Actor';
$GLOBALS['movie-composers'] = 'Compositor(es)';
$GLOBALS['movie-error-1'] = 'No se proporcionó ningún ID de película';
$GLOBALS['movie-error-2'] = 'No se encontró ninguna película con el ID: ';

// EditableMovie.php
$GLOBALS['movie-edit'] = 'Editar';
$GLOBALS['movie-save-changes'] = 'Guardar cambios';
$GLOBALS['movie-cancel'] = 'Cancelar';
$GLOBALS['movie-editable-new-title'] = 'Nuevo título';
$GLOBALS['movie-editable-new-release-date'] = 'Nueva fecha de estreno';
$GLOBALS['movie-editable-new-synopsis'] = 'Nueva sinopsis';
$GLOBALS['movie-editable-new-time-duration'] = 'Nueva duración';
$GLOBALS['movie-editable-new-note'] = 'Nueva nota';
$GLOBALS['movie-editable-new-rating'] = 'Nueva clasificación';
$GLOBALS['movie-editable-error-unknown-type'] = 'Error: tipo desconocido';

////////// PERSON //////////
// person.php
$GLOBALS['person-error-1'] = 'No se proporcionó ningún ID de persona';
$GLOBALS['person-error-2'] = 'No se encontró ninguna persona con el ID: ';

////////// LOGIN //////////
// login.php
$GLOBALS['login-title'] = 'Por favor inicie sesión';
$GLOBALS['login-user'] = 'Usuario';
$GLOBALS['login-password'] = 'Contraseña';
$GLOBALS['login-submit'] = 'Iniciar sesión';
$GLOBALS['login-error'] = 'Usuario o contraseña incorrectos, por favor intente de nuevo';

////////// SQL //////////
// PdoWrapper.php
$GLOBALS['pdo-connect-error'] = 'Error al conectar con la base de datos: ';
$GLOBALS['pdo-execute-error'] = 'Error al ejecutar la consulta: ';

// MovieDB.php
$GLOBALS['movie-db-already-exists'] = 'La película ya existe';

// PersonDB.php
$GLOBALS['person-db-already-exists'] = 'La persona ya existe';

// TagDB.php
$GLOBALS['tag-db-already-exists'] = 'La etiqueta ya existe';

////////// API //////////
// add-tag.php
$GLOBALS['api-add-tag-error-1'] = 'No se proporcionó ninguna etiqueta';
$GLOBALS['api-add-tag-error-2'] = 'Error al agregar la etiqueta. Por favor, asegúrese de que la etiqueta no exista ya';

// get-data.php
$GLOBALS['api-get-data-table-not-valid'] = 'La tabla solicitada no es válida. Las tablas válidas son: movies, tag y person';
$GLOBALS['api-get-data-attribute-value-not-set'] = 'El atributo y/o el valor no están establecidos';
$GLOBALS['api-get-data-table-not-set'] = 'La tabla no está establecida';

// get-localized-text.php
$GLOBALS['api-get-localized-text-error-1'] = 'No se proporcionó ningún idioma';
$GLOBALS['api-get-localized-text-error-2'] = 'Texto no encontrado';
$GLOBALS['api-get-localized-text-error-3'] = 'No se proporcionó ningún texto';

// get-movies-by-tag.php
$GLOBALS['api-get-movies-by-tag-error-1'] = 'Falta el ID de etiqueta';

// language.php
$GLOBALS['api-language-error-1'] = 'No se proporcionó ningún método';
$GLOBALS['api-language-error-2'] = 'Método no válido';
$GLOBALS['api-language-error-3'] = 'Idioma no válido';
$GLOBALS['api-language-error-4'] = 'Error al cambiar el idioma';

// set-seen-favorite.php
$GLOBALS['api-set-seen-error-1'] ='No se proporcionó ningún ID de película';
$GLOBALS['api-set-seen-error-2'] = 'No se proporcionó ningún parámetro \'Visto\'';
$GLOBALS['api-set-seen-success'] = 'Atributo \'Visto\' actualizado exitosamente';

