<?php
// Strip Laragon folder from request URI super global for clarity in routes array
$requestUri = str_replace('/phpforbeginners', '', $_SERVER['REQUEST_URI']);

$uri = parse_url($requestUri)['path'];

require 'routes.php';

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