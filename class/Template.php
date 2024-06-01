<?php
class Template
{
    public static function render(string $content) : void
    {
        //$lang = Cookies::get('language');
        $lang = $GLOBALS['CURRENT_LANGUAGE'];
        require_once $GLOBALS['LOCALIZATION_DIR'] . $lang . '.php';
        ?>
        <!doctype html>
        <html lang="<?php echo $lang ?>">
        <head>
            <meta charset="UTF-8">
            <title><?php echo $GLOBALS['template-title'] ?></title>
            <link rel="stylesheet" href="../css/my_movies.css">
            <!--script src="../js/script.js"></script-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </head>
        <body>
            <?php include "header.php" ?>
            <div id="content"> <?php echo $content ?> </div>
            <?php include "footer.php" ?>
        </body>
        </html>
        <script>
            document.addEventListener('DOMContentLoaded', function()
            {
                initializeTheme();
                document.getElementById('theme-toggle').addEventListener('click', changeTheme);
                document.getElementById('language-dropdown').querySelectorAll('li button').forEach(function(button)
                {
                    button.addEventListener('click', function() { setLanguage(button.textContent); });
                });
                document.getElementById('language-button').textContent = '<?php echo $lang ?>';
            });

            function initializeTheme()
            {
                const savedTheme = localStorage.getItem('theme') || 'dark';
                document.body.classList.add(`${savedTheme}-theme`);
                document.getElementById('theme-toggle').textContent = (savedTheme === 'dark' ? '<?php echo $GLOBALS['template-dark-theme'] ?>' : '<?php echo $GLOBALS['template-light-theme'] ?>');
            }

            function changeTheme()
            {
                let dark = localStorage.getItem('theme') !== 'dark';
                let oldTheme = dark ? 'light-theme' : 'dark-theme';
                let newTheme = dark ? 'dark-theme' : 'light-theme';

                document.body.classList.replace(oldTheme, newTheme);
                document.getElementById('theme-toggle').textContent = (dark ? '<?php echo $GLOBALS['template-dark-theme'] ?>' : '<?php echo $GLOBALS['template-light-theme'] ?>');
                localStorage.setItem('theme', dark ? 'dark' : 'light');
            }

            function setLanguage(newLanguage)
            {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../ajax/language.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('method=set&language=' + newLanguage);
                xhr.onreadystatechange = function()
                {
                    if (xhr.readyState === 4 && xhr.status === 200)
                    {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) { location.reload(); }
                        else { console.log('Erreur:', response.error); }
                    }
                }
            }
        </script>
    <?php
    }
}