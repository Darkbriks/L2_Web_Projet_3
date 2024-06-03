<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-title" href="#"><?php echo $GLOBALS['header-title']; ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="home.php"><?php echo $GLOBALS['header-home']; ?></a></li>
                    <li class="nav-item"><a class="nav-link active" href="all-movies.php"><?php echo $GLOBALS['header-movies']; ?></a></li>
                    <li class="nav-item"><a class="nav-link active" href="all-people.php"><?php echo $GLOBALS['header-peoples']; ?></a></li>
                    <li class="nav-item"><a class="nav-link active" href="admin.php"><?php echo $GLOBALS['header-admin']; ?></a></li>
                    <!-- TODO: ajouter l'attribut "active" uniquement a la page courante -->

                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>

                <div class="d-flex">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?><form class="d-flex" action="logout.php" method="POST"><button class="btn btn-outline-danger" type="submit"><?php echo $GLOBALS['header-logout']; ?></button></form><?php } ?>

                        <li class="nav-item dropdown dropstart" id="theme-dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="theme-button"><?php echo $GLOBALS['header-theme']; ?></button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button" data-theme="light" value="dark"><i class ="bi-moon-fill"></i><?php echo $GLOBALS['template-dark-theme']; ?></button></li>
                                <li><button class="dropdown-item" type="button" data-theme="dark" value="light"><i class ="bi-sun-fill"></i><?php echo $GLOBALS['template-light-theme']; ?></button></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropstart" id="language-dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="language-button"><?php echo $GLOBALS['header-language-dropdown-default']; ?></button>
                            <ul class="dropdown-menu"><?php foreach ($GLOBALS['languages-list'] as $key => $language) { $flagPath = '../uploads/flags/' . $key . '.png';  ?><li><button class="dropdown-item" type="button" data-language="<?php echo $key; ?>"><img src="<?php echo $flagPath; ?>" alt="<?php echo $language; ?> flag" style="width: 20px; height: auto; margin-right: 8px;"><?php echo $language; ?></button></li><?php } ?></ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
