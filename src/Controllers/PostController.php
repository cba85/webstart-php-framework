<?php

namespace App\Controllers;

use App\Repositories\PostRepository;
use Rakit\Validation\Validator;
use Laminas\Diactoros\Response\RedirectResponse;

class PostController extends Controller
{
    public function index()
    {
        /*
        // No container

        $msg = new \Plasticbrain\FlashMessages\FlashMessages;

        $posts = (new PostRepository($this->pdo))->all();

        $html = $this->twig->render('posts.html', ['msg' => $msg, "posts" => $posts]);
        $this->response->getBody()->write($html);

        return $this->response;
        */

        // Container

        $msg = new \Plasticbrain\FlashMessages\FlashMessages;

        $posts = (new PostRepository($this->container->get('pdo')))->all();

        $html = $this->container->get('twig')->render('posts.html', ['msg' => $msg, "posts" => $posts]);
        $this->container->get('response')->getBody()->write($html);

        return $this->container->get('response');
    }

    public function store($req)
    {
        $params = $req->getParsedBody();

        $validator = new Validator;

        $validation = $validator->validate($params, [
            'title' => 'required|min:5',
            'body' => 'required|min:15',
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

            return new RedirectResponse("/posts");
        }

        // Insérer en base de données

        // No container
        //$postRepository = new PostRepository($this->pdo);

        // Container
        $postRepository = new PostRepository($this->container->get('pdo'));

        $post = new \App\Models\Post;
        $post->title = $params['title'];
        $post->body = $params['body'];

        $postRepository->save($post);

        $msg = new \Plasticbrain\FlashMessages\FlashMessages;
        $msg->success("L'article a bien été créé !");

        return new RedirectResponse("/posts");
    }
}
