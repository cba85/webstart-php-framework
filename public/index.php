<?php

if (!session_id()) @session_start();

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/../views");
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true
]);

try {
    $pdo = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
} catch (\PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$container = new DI\Container([
    'response' => new \Laminas\Diactoros\Response,
    'twig' => $twig,
    'pdo' => $pdo
]);

$strategy = (new League\Route\Strategy\ApplicationStrategy)->setContainer($container);
$router   = (new League\Route\Router)->setStrategy($strategy);

//$router = new League\Route\Router;

//$router->middleware(new \App\Middlewares\MaintenanceMiddleware);

$routes = require(__DIR__ . "/../routes/routes.php");

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
