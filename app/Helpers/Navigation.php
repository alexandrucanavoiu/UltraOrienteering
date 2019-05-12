<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Route;

class Navigation
{
    public static function isActiveRoute($routes, $output = 'active')
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
        return ''; // Route is not active, return default result
    }
}
