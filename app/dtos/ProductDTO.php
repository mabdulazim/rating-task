<?php

namespace App\DTOs;

class ProductDTO {

    public $productId;
    public $userId;
    public $code;
    public $name;
    public $description;
    public $price;

    public function __construct($productId, $userId, $code, $name, $description, $price) 
    {
        $this->productId   = $productId;
        $this->userId      = $userId;
        $this->code        = $code;
        $this->name        = $name;
        $this->description = $description;
        $this->price       = $price;
    }

    public function toArray()
    {
        return array_filter([
            'code'         => $this->code,
            'name'         => $this->name,
            'description'  => $this->description,
            'price'        => $this->price
        ]);
    }

}

