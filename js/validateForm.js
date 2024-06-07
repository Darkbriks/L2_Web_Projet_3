document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.add-person-form').addEventListener('submit', function (e) {
        console.log('bbbbbbb');
        if (document.getElementById('add-person-form-msg')) {
            document.getElementById('add-person-form-msg').innerHTML = '';
            e.preventDefault();
            if (checkForm('.add-person-form','add-person-form-msg')) {
                document.querySelector('.add-person-form').submit();
            }
        }
    });
    document.querySelector('.update-person-form').addEventListener('submit', function (e) {
        console.log('cccc');
        if(document.getElementById('update-person-form-msg')) {
            document.getElementById('update-person-form-msg').innerHTML = '';
            e.preventDefault();
            if (checkForm('.update-person-form', 'update-person-form-msg')) {
                document.querySelector('.update-person-form').submit();
            }
        }
    })

});
function checkForm($form_name,element){
    let form = document.querySelector($form_name);
    let name = form.querySelector('#person-first-name').value;
    let surname = form.querySelector('#person-last-name').value;
    let birthDate = form.querySelector('#person-birth-date').value;
    let deathDate = form.querySelector('#person-death-date').value;
    //let image = form.querySelector('#person-image').value;
    return validateTextInput(name, element) &&
        validateTextInput(surname, element) &&
        validateDateInput(birthDate, element) &&
        validatePotentiallyEmptyDateInput(deathDate, element);
        //validateImageInput(image, element);
}

function validateTextInput(input, exception, minLength = 3, maxLength = 50) {
    if (input === null || input.length < minLength || input.length > maxLength) {
        showMovieFormMsg(exception);
        return false
    }
    return true
}

function validateNumberInput(input, exception, min = 0, max = 999) {
    if (isNaN(input) || input < min || input > max) {
        showMovieFormMsg(exception);
        return false
    }
    return true
}

function validateDateInput(input, exception) {
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(input)) {
        showMovieFormMsg(exception);
        return false
    }
    return true
}

function validatePotentiallyEmptyDateInput(input, exception) {
    if (input === '0000-00-00' || input === null) {
        return true;
    }
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateRegex.test(input)) {
        showMovieFormMsg(exception);
        return false
    }
    return true
}

function validateImageInput(image, exception) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (image.error !== 0 || !allowedTypes.includes(image.type)) {
        showMovieFormMsg(exception);
        return false
    }
    return true
}

function convertData(data) {
    for (const key in data) {
        if (Array.isArray(data[key])) {
            data[key] = data[key].map(v => ValidateForm.sanitize(v));
        } else {
            data[key] = ValidateForm.sanitize(data[key]);
        }
    }
    return data;
}

function sanitize(value) {
    return value.trim().replace(/</g, "&lt;").replace(/>/g, "&gt;");
}

 function showMovieFormMsg(msg, type, element)
 {
     set_user_msg(msg, type, document.getElementById(element))
     scroll(0, 0);
 }