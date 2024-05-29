<h2>Veuillez vous connecter</h2>
<?php if (isset($login_error)) { echo "<p>$login_error</p>"; } ?>
<form action="admin.php" method="POST">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Connexion">
</form>