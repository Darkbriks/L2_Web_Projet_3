<div class="login-form">
    <form action="admin.php" method="POST">
        <?php if (isset($login_error)) { echo "<div class='alert alert-warning' role='alert'>$login_error</div>"; } ?>
        <h2><?php echo $GLOBALS['login-title']; ?></h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder=<?php echo $GLOBALS['login-user']; ?>>
            <label for="username"><?php echo $GLOBALS['login-user']; ?></label>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $GLOBALS['login-password']; ?>">
            <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <button type="submit" class="btn btn-primary" id="login-form-submit"><?php echo $GLOBALS['login-submit']; ?></button>
    </form>
</div>
<script src="../js/password.js"></script>