<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function __invoke()
    {
        $html = $this->twig->render('index.html', ['name' => 'Fabien']);
        $this->response->getBody()->write($html);

        return $this->response;
    }
}
