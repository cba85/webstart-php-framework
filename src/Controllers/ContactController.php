<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function displayForm()
    {
        // TODO: use a better package
        $msg = new \Plasticbrain\FlashMessages\FlashMessages;

        $html = $this->twig->render('contact.html', ['msg' => $msg]);
        $this->response->getBody()->write($html);

        return $this->response;
    }

    public function send()
    {
        $this->response->getBody()->write("ok");

        return $this->response;
    }
}
