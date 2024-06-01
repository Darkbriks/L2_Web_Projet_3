<h2><?php echo $GLOBALS['login-title']; ?></h2>
<?php if (isset($login_error)) { echo "<p>$login_error</p>"; } ?>
<form action="admin.php" method="POST">
    <label for="username"><?php echo $GLOBALS['login-user']; ?></label>
    <input type="text" id="username" name="username" required>
    <label for="password"><?php echo $GLOBALS['login-password']; ?></label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="<?php echo $GLOBALS['login-submit']; ?>">
</form>