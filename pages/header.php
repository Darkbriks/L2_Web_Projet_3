<?php
$currentPage = basename($_SERVER['PHP_SELF']);
echo "Current page: " . $currentPag . "<br>";
$isHomeActive = ($currentPage === 'home.php');
$isAllMoviesActive = ($currentPage === 'all-movies.php');
$isAllPeopleActive = ($currentPage === 'all-people.php');
$isAdminActive = ($currentPage === 'admin.php');
$isAdvancedSearchActive = ($currentPage === 'advanced-search.php');

echo "Is Home Active: " . ($isHomeActive ? 'true' : 'false') . "<br>";
echo "Is All Movies Active: " . ($isAllMoviesActive ? 'true' : 'false') . "<br>";
echo "Is All People Active: " . ($isAllPeopleActive ? 'true' : 'false') . "<br>";
echo "Is Admin Active: " . ($isAdminActive ? 'true' : 'false') . "<br>";
echo "Is Advanced Search Active: " . ($isAdvancedSearchActive ? 'true' : 'false') . "<br>";
?>
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-title" href="#"><?php echo $GLOBALS['header-title']; ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item <?php echo ($currentPage === 'home.php') ? 'active' : ''; ?>"><a class="nav-link" href="home.php"><?php echo $GLOBALS['header-home']; ?></a></li>
                    <li class="nav-item <?php echo ($currentPage === 'all-movies.php') ? 'active' : ''; ?>"><a class="nav-link" href="all-movies.php"><?php echo $GLOBALS['header-movies']; ?></a></li>
                    <li class="nav-item <?php echo ($currentPage === 'all-people.php') ? 'active' : ''; ?>"><a class="nav-link" href="all-people.php"><?php echo $GLOBALS['header-peoples']; ?></a></li>
                    <li class="nav-item <?php echo ($currentPage === 'admin.php') ? 'active' : ''; ?>"><a class="nav-link" href="admin.php"><?php echo $GLOBALS['header-admin']; ?></a></li>
                    <li class="nav-item <?php echo ($currentPage === 'advanced-search.php') ? 'active' : ''; ?>"><a class="nav-link" href="advanced-search.php"><?php echo $GLOBALS['header-advanced-search']; ?></a></li>
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