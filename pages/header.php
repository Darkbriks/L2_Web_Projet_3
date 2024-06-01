<header>
    <div class="banner">
        <h1><?php echo $GLOBALS['header-title']; ?></h1>
        <nav>
            <ul>
                <li><a href="home.php"><?php echo $GLOBALS['header-home']; ?></a></li>
                <li><a href="allMovies.php"><?php echo $GLOBALS['header-movies']; ?></a></li>
                <li><a href="allPeople.php"><?php echo $GLOBALS['header-peoples']; ?></a></li>
                <li><a href="admin.php"><?php echo $GLOBALS['header-admin']; ?></a></li>
            </ul>
        </nav>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
            <form action="logout.php" method="POST">
                <input type="submit" value="<?php echo $GLOBALS['header-logout']; ?>">
            </form>
        <?php } ?>
        <button id="theme-toggle"><?php echo $GLOBALS['header-theme']; ?></button>
        <div class="dropdown" id="language-dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="language-button">
                <?php echo $GLOBALS['header-language-dropdown-default']; ?>
            </button>
            <ul class="dropdown-menu">
                <?php foreach ($GLOBALS['languages-list'] as $key => $language) { ?>
                    <li><button class="dropdown-item" type="button" data-language="<?php echo $key; ?>"><?php echo $language; ?></button></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>