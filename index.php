<?php
declare(strict_types=1);

$pl_autoload_register(function($class) {
    require __DIR__ . "/src/$class.php";
});

$parts = explode('/', $_SERVER['REQUEST_URI']);

if ($parts[1] != "products") {
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

$controller = new ProductController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);