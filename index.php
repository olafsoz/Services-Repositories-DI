<?php

use App\Controllers\ProductController;
use App\Controllers\WebsiteController;
use App\Redirect;
use App\Repositories\Product\MySQLProductRepository;
use App\Repositories\Product\ProductRepository;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ProductRepository::class => DI\create(MySQLProductRepository::class)
]);
$container = $builder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [WebsiteController::class, 'main']);
    $r->addRoute('GET', '/home', [ProductController::class, 'showAll']);
    $r->addRoute('GET', '/add', [ProductController::class, 'form']);
    $r->addRoute('POST', '/add', [ProductController::class, 'add']);
    $r->addRoute('GET', '/view/{id:\d+}', [ProductController::class, 'showOne']);
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1][0];
        $vars = $routeInfo[1][1];
        $response = (new $handler($container))->$vars($routeInfo[2]);

        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);

        if ($response instanceof View) {
            try {
                echo $twig->render($response->getPath() . '.html', $response->getVariables());
            } catch (Exception $e) {
            }
        }
        if ($response instanceof Redirect)
        {
            header('Location: ' . $response->getLocation());
            exit;
        }
        break;
}
