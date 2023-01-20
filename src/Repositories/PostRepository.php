<?php

namespace App\Repositories;

class PostRepository extends Repository
{
    public function all()
    {
        $statement = $this->pdo->query("SELECT * FROM posts");
        return $statement->fetchAll(\PDO::FETCH_CLASS, \App\Models\Post::class);
    }

    public function save($post)
    {
        $statement = $this->pdo->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
        $statement->execute([
            'title' => $post->title,
            'body' => $post->body,
        ]);
    }
}
