<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-title" href="#"><?php echo $GLOBALS['header-title']; ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'home.php') ? 'active' : ''; ?>" href="home.php"><?php echo $GLOBALS['header-home']; ?></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'all-movies.php') ? 'active' : ''; ?>" href="all-movies.php"><?php echo $GLOBALS['header-movies']; ?></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'all-people.php') ? 'active' : ''; ?>" href="all-people.php"><?php echo $GLOBALS['header-peoples']; ?></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'favorites.php') ? 'active' : ''; ?>" href="favorites.php"><?php echo $GLOBALS['header-favorites']; ?></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'admin.php') ? 'active' : ''; ?>" href="admin.php"><?php echo $GLOBALS['header-admin']; ?></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page === 'advanced-search.php') ? 'active' : ''; ?>" href="advanced-search.php"><?php echo $GLOBALS['header-advanced-search']; ?></a></li>
                    <li>
                        <div class="form-floating">
                            <input class="form-control form-control-sm" type='text' name='search' id='search' required placeholder='<?php echo $GLOBALS['header-search'] ?>'>
                            <label for='search'><?php echo $GLOBALS['header-search'] ?></label>
                            <div class="search-list list-group" id="search-list"></div>
                        </div>
                    </li>
                </ul>

                <div class="d-flex">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
                            <form class="d-flex" action="logout.php" method="POST"><button class="btn btn-outline-danger" type="submit"><?php echo $GLOBALS['header-logout']; ?></button></form>
                        <?php } else { ?>
                            <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#loginModal"><?php echo $GLOBALS['header-login']; ?></button>
                        <?php } ?>
                        <li class="nav-item dropdown dropstart" id="theme-dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="theme-button"><?php echo $GLOBALS['header-theme']; ?></button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button" data-theme="light" value="dark"><i class="bi-moon-fill"></i><?php echo $GLOBALS['template-dark-theme']; ?></button></li>
                                <li><button class="dropdown-item" type="button" data-theme="dark" value="light"><i class="bi-sun-fill"></i><?php echo $GLOBALS['template-light-theme']; ?></button></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropstart" id="language-dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="language-button"><?php echo $GLOBALS['header-language-dropdown-default']; ?></button>
                            <ul class="dropdown-menu"><?php foreach ($GLOBALS['languages-list'] as $key => $language) { $flagPath = '../uploads/flags/' . $key . '.png'; ?><li><button class="dropdown-item" type="button" data-language="<?php echo $key; ?>"><img src="<?php echo $flagPath; ?>" alt="<?php echo $language; ?> flag" style="width: 20px; height: auto; margin-right: 8px;"><?php echo $language; ?></button></li><?php } ?></ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel"><?php echo $GLOBALS['login-title']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="admin.php" method="POST">
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
                    <button type="submit" class="btn btn-primary"><?php echo $GLOBALS['login-submit']; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('modalLoginForm').addEventListener('submit', function(event) {
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
                let modal = new bootstrap.Modal(document.getElementById('loginModal'));
                modal.hide();

                document.querySelector('.btn-login[data-bs-target="#loginModal"]').classList.replace('btn-outline-primary', 'btn-outline-danger');
                document.querySelector('.btn-login[data-bs-target="#loginModal"]').innerHTML = '<?php echo $GLOBALS['header-logout']; ?>';
                document.querySelector('.btn-login[data-bs-target="#loginModal"]').removeAttribute('data-bs-toggle');
                document.querySelector('.btn-login[data-bs-target="#loginModal"]').removeAttribute('data-bs-target');
                document.querySelector('.btn-login[data-bs-target="#loginModal"]').setAttribute('href', 'logout.php');
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
</script>
