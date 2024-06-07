<div class="login-form">
    <form id="loginForm" action="admin.php" method="POST">
        <?php if (isset($login_error)) { echo "<div class='alert alert-warning' role='alert'>$login_error</div>"; } ?>
        <h2><?php echo $GLOBALS['login-title']; ?></h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $GLOBALS['login-user']; ?>">
            <label for="username"><?php echo $GLOBALS['login-user']; ?></label>
        </div>
        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $GLOBALS['login-password']; ?>">
                <label for="password"><?php echo $GLOBALS['login-password']; ?></label>
            </div>
            <button type="button" class="btn btn-outline-secondary" id="toggle-password"><i class="fas fa-eye"></i></button>
        </div>
        <button type="submit" class="btn btn-primary" id="login-form-submit"><?php echo $GLOBALS['login-submit']; ?></button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('toggle-password').addEventListener('click', function() {
            let passwordInput = document.getElementById('password');
            passwordInput.setAttribute('type', (passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'));
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = event.target;

            let formData = new FormData(form);
            formData.append('ajax', true);

            fetch(form.action, {
                method: form.method,
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    let alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-warning';
                    alertDiv.role = 'alert';
                    alertDiv.innerText = data.error;
                    form.insertBefore(alertDiv, form.firstChild);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
