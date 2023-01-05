<?php

namespace App\Controllers;

use Laminas\Diactoros\Response;

class Controller
{
    protected $response;
    protected $twig;

    public function __construct()
    {
        $this->response = new Response;

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/../../views");
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
    }
}
