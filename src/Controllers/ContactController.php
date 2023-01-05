<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function displayForm()
    {
        //$response = new Response;
        $html = $this->twig->render('contact.html');
        $this->response->getBody()->write($html);
        return $this->response;
    }
}
