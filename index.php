<?php

require 'functions.php';

// Strip Laragon folder from request URI super global for clarity in routes array
$requestUri = str_replace('/phpforbeginners', '', $_SERVER['REQUEST_URI']);

$uri = parse_url($requestUri)['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
];

function routeToController($uri, $routes) {
    if(!array_key_exists($uri, $routes)) {
        abort();
    }
    require $routes[$uri];
}

function abort($code = 404) {
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

routeToController($uri, $routes);