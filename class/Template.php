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
        <html lang="<?php echo $lang ?>" data-bs-theme="dark">
        <head>
            <meta charset="UTF-8">
            <title><?php echo $GLOBALS['template-title'] ?></title>
            <link rel="stylesheet" href="../css/my_movies.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
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
                changeTheme(localStorage.getItem('theme') || 'dark')

                document.getElementById('theme-dropdown').querySelectorAll('.dropdown-item').forEach(function(button)
                {
                    button.addEventListener('click', function() { changeTheme(button.value); });
                });

                document.getElementById('language-dropdown').querySelectorAll('.dropdown-item').forEach(function(button)
                {
                    button.addEventListener('click', function() { setLanguage(button.textContent); });
                });

                document.getElementById('language-button').textContent = '<?php echo $lang ?>';
            });

            function changeTheme(theme)
            {
                document.getElementById('theme-button').textContent = (theme === "dark" ? '<?php echo $GLOBALS['template-dark-theme'] ?>' : '<?php echo $GLOBALS['template-light-theme'] ?>');
                localStorage.setItem('theme', theme);
                document.documentElement.setAttribute('data-bs-theme', theme)
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

            function set_user_msg(msg, type="info")
            {
                let msg_div = document.createElement('div');
                msg_div.classList.add('alert', 'alert-' + type);
                msg_div.textContent = msg;
                document.getElementById('content').prepend(msg_div);
            }
        </script>
    <?php
    }
}