<?php

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        echo '<br> Router - ' . $routes[$uri] . '<br>';
        echo '<br> Router - ' . $routes[$uri] . '<br>';
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404) {
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

$routes = require('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);