function checkPersonForm(form_name,element){
    let form = document.querySelector(form_name);
    let name = form.querySelector('#person-first-name').value;
    let surname = form.querySelector('#person-last-name').value;
    let birthDate = form.querySelector('#person-birth-date').value;
    let deathDate = form.querySelector('#person-death-date').value;
    let image = form.querySelector('#person-image').files[0];
    console.log(name, surname, birthDate, deathDate, image);
    if(validateTextInput(name, element) &&
        validateTextInput(surname, element) &&
        validateDateInput(birthDate, element) &&
        validatePotentiallyEmptyDateInput(deathDate, element) &&
        validateImageInput(image, element))
    {
        console.log('ok')
        return true
    }
    else{
        console.log('not ok')
    }
}

function checkMovieForm(form_name,element){
    let form = document.querySelector(form_name);
    let title = form.querySelector('#title').value.trim();
    let releaseDate = form.querySelector('#release_date').value.trim();
    let synopsis = form.querySelector('#synopsis').value.trim();
    let image = form.querySelector('#person-image').files[0];
    let timeDuration = parseInt(form.querySelector('#duration').value);
    let note = parseFloat(form.querySelector('#note').value);
    let rating = form.querySelector('#age_limit').value.trim();
    let trailerPath = form.querySelector('#trailer').value.trim();
    console.log(title,releaseDate,synopsis, image, timeDuration, note, rating, trailerPath);
    if(validateTextInput(title, element) &&
        validateNumberInput(timeDuration, element) &&
        validateNumberInput(note, element) &&
        validateNumberInput(rating, element) &&
        validateTrailerInput(trailerPath, element) &&
        validateTextInput(synopsis, element) &&
        validateDateInput(releaseDate, element) &&
        validateImageInput(image, element))
    {
        console.log('ok')
        return true
    }
    else{
        console.log('not ok')
    }
}

function checkSingleForm(form_name, class_name, validate_name, element){

}
