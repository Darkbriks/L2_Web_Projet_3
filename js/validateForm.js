
function validateTextInput(input, exception, minLength = 3, maxLength = 50) {
    if (input === null || input.length < minLength || input.length > maxLength) {
        showMovieFormMsg('a',"warning",exception);
        return false
    }
    return true
}

function validateNumberInput(input, exception, min = 0, max = 999) {
    if (isNaN(input) || input < min || input > max) {
        showMovieFormMsg('a',"warning",exception);
        return false
    }
    return true
}

function validateDateInput(input, exception) {
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(input)) {
        showMovieFormMsg('a',"warning",exception);
        return false
    }
    return true
}

function validatePotentiallyEmptyDateInput(input, exception) {
    if (input === '0000-00-00' || input.length === 0) {
        return true;
    }
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(input)) {
        showMovieFormMsg('a',exception,"warning",exception);
        return false
    }
    return true
}

function validateImageInput(image, exception) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (image === null || !allowedTypes.includes(image.type)) {
        showMovieFormMsg('a',"warning",exception);
        return false;
    }
    return true;
}

function validateTrailerInput(input, exception, min = 3, max = 100) {
    if(input === null || input.length < min || input.length > max || input.includes('https://www.youtube.com/embed/')) {
        showMovieFormMsg('a', exception,"warning",exception);
        return false;
    }
    return true;
}


 function showMovieFormMsg(msg, type, element)
 {
     set_user_msg(msg, type, document.getElementById(element))
     scroll(0, 0);
 }