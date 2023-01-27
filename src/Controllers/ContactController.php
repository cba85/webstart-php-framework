<?php

namespace App\Controllers;

use Rakit\Validation\Validator;
use Laminas\Diactoros\Response\RedirectResponse;

class ContactController extends Controller
{
    public function displayForm()
    {
        /*
        // No container
        // TODO: use a better package
        $msg = new \Plasticbrain\FlashMessages\FlashMessages;

        $html = $this->twig->render('contact.html', ['msg' => $msg]);
        $this->response->getBody()->write($html);

        return $this->response;
        */

        // TODO: use a better package
        $msg = new \Plasticbrain\FlashMessages\FlashMessages;

        $html = $this->container->get('twig')->render('contact.html', ['msg' => $msg]);
        $this->container->get('response')->getBody()->write($html);

        return $this->container->get('response');
    }

    public function send($req)
    {
        $params = $req->getParsedBody();

        // BEGIN MIDDLEWARE
        $validator = new Validator;

        $validation = $validator->validate($params, [
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();

            $message = "<ul>";
            foreach ($errors->all() as $error) {
                $message .= "<li>{$error}</li>";
            }
            $message .= "</ul>";

            // TODO: use a better package
            $msg = new \Plasticbrain\FlashMessages\FlashMessages;
            $msg->error($message);

            return new RedirectResponse("/contact");
        }
        // END MIDDLEWARE

        // Insérer en base de données

        // No container
        //$statement = $this->pdo->prepare("INSERT INTO contacts (email, subject, message) VALUES (:email, :subject, :message)");

        // Container
        $statement = $this->container->get('pdo')->prepare("INSERT INTO contacts (email, subject, message) VALUES (:email, :subject, :message)");

        $statement->execute([
            'email' => $params['email'],
            'message' => $params['message'],
            'subject' => $params['subject']
        ]);

        $msg = new \Plasticbrain\FlashMessages\FlashMessages;
        $msg->success("Votre message a bien été envoyé !");

        return new RedirectResponse("/contact");
    }
}
