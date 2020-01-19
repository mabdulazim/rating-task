<?php

namespace App\Repositories;

use App\Models\Products;

class ProductRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Products();
    }

    public function filter($code)
    {
        if($code == null)
            return $this->model->find();

        return $this->model->find(["conditions" => "code LIKE '%$code%'"]);
    }

    public function updateByProductIdUserId($productId, $userId, $data)
    {
        $product = $this->model->findFirst([
            "conditions" => "id = $productId AND user_id = $userId",
            "for_update" => true
        ]);
        return $product->update($data);
    }

}