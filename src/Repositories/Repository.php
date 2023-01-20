<?php

namespace App\Repositories;

class Repository
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}
