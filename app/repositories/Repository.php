<?php

namespace App\Repositories;

use \Phalcon\Mvc\Model;

class Repository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct()
    {
        $this->model = new Model();
    }

    public function create(array $data)
    {
        $this->model->save($data);
        return $this->model;
    }

    public function getById($id)
    {
        return $this->model->findFirst(["conditions" => "id = $id"]);
    }

    public function updateById($id, $data)
    {
        return $this->model
        ->findFirst(["conditions" => "id = $id"])
        ->save($data);
    }


}