<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function __invoke()
    {
        /*
        // No container
        $html = $this->twig->render('index.html', ['name' => 'Fabien']);
        $this->response->getBody()->write($html);

        return $this->response;
        */

        // Container
        $html = $this->container->get('twig')->render('index.html', ['name' => 'Fabien']);
        $this->container->get('response')->getBody()->write($html);

        return $this->container->get('response');
    }
}
