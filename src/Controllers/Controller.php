<?php

namespace App\Controllers;

class Controller
{
    protected $response;
    protected $twig;
    protected $pdo;

    public function __construct()
    {
        $this->response = new \Laminas\Diactoros\Response;

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/../../views");
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);

        try {
            $this->pdo = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        } catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
