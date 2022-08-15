<?php

namespace Helpers;

class HTTP
{
    static $base = "http://localhost/app/mini_projects/login_system";

    static function redirect($path, $query = "")
    {
        $url = static::$base . $path;
        if($query) $url .= "?$query";

        header("location: $url");
        exit();
    }
}