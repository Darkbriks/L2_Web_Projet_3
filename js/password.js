document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var passwordFieldType = passwordInput.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordInput.setAttribute('type', 'text');
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    });
});