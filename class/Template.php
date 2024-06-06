<?php
class Template
{
    public static function render(string $content) : void
    {
        $lang = $_SESSION['language'] ?? 'EN';
        require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';
        ?>
        <!doctype html>
        <html lang="<?php echo $lang ?>" data-bs-theme="dark">
        <head>
            <meta charset="UTF-8">
            <title><?php echo $GLOBALS['template-title'] ?></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="../css/my_movies.css">
        </head>
        <body>
            <?php include "header.php" ?>
            <div id="content"> <?php echo $content ?> </div>
            <?php include "footer.php" ?>
        </body>
        </html>
        <script>
            document.addEventListener('DOMContentLoaded', () => { document.getElementById('language-button').textContent = '<?php echo $lang ?>'; });

            function changeTheme(theme)
            {
                document.getElementById('theme-button').textContent = (theme === "dark" ? '<?php echo $GLOBALS['template-dark-theme'] ?>' : '<?php echo $GLOBALS['template-light-theme'] ?>');
                localStorage.setItem('theme', theme);
                document.documentElement.setAttribute('data-bs-theme', theme)
                document.documentElement.setAttribute('data-theme', theme);
            }
        </script>
        <script src="../js/template.js"></script>
    <?php
    }
}