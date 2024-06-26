<?php

class Autoloader
{
    static function register(): void { spl_autoload_register(array(__CLASS__, 'autoload')); }

    static function autoload($class_name): void
    {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
        require $class_name . '.php';
    }
}

?>