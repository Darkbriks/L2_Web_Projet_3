<?php

class Cookies
{
    public static function get($name): ?string
    {
        return htmlspecialchars($_COOKIE[$name]) ?? null;
    }

    public static function set($name, $value, $expire = 0, $path = null, $domain = null, $secure = false, $httponly = true): bool
    {
        return setcookie(htmlspecialchars($name), $value, $expire, $path, $domain, $secure, $httponly);
    }
}