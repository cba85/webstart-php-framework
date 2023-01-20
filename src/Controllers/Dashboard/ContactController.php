<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        /*
        $statement = $this->pdo->query("SELECT * FROM contacts WHERE id = 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, \App\Models\Contact::class);
        $results = $statement->fetch();
        */

        $statement = $this->pdo->query("SELECT * FROM contacts");
        $results = $statement->fetchAll(\PDO::FETCH_CLASS, \App\Models\Contact::class);

        print_r($results);
        die();

        $this->response->getBody()->write("Index");

        return $this->response;
    }
}
