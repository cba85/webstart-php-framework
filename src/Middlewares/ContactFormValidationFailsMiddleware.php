<?php

namespace App\Middlewares;

use Rakit\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

class ContactFormValidationFailsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $req, RequestHandlerInterface $handler): ResponseInterface
    {
        $validator = new Validator;

        $validation = $validator->validate($req->getParsedBody(), [
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

        return $handler->handle($req);
    }
}
