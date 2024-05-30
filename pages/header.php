<header>
    <div class="banner">
        <h1>Home Of Movies</h1>
        <nav>
            <ul>
                <li><a href="home.php">Accueil</a></li>
                <li><a href="allMovies.php">Films</a></li>
                <li><a href="allPeople.php">Peoples</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
        <button id="theme-toggle"></button>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
            <form action="logout.php" method="POST">
                <input type="submit" value="Déconnexion">
            </form>
        <?php } ?>
    </div>
</header>