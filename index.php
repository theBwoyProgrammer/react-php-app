<?php

$parts = explode('/', $_SERVER['REQUEST_URI']) ;

if ($parts[1] != "products") {
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

var_dump($id);