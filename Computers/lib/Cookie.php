<?php
class Cookie
{

    public static function set($key, $val)
    {
        setcookie($key, $val, time()+360000, '/');
    }

    public static function remove($key)
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600, '/', '', 0, 0);
        }
    }

    public static function destroy()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if ($name != 'PHPSESSID') {
                    setcookie($name, '', time() - 3600);
                    setcookie($name, '', time() - 3600, '/'); 
                }
            }
        }
    }

}
