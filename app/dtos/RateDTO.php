<?php

namespace App\DTOs;

class RateDTO {

    public $productId;
    public $userId;
    public $rate;

    public function __construct($productId, $userId, $rate) 
    {
        $this->productId = $productId;
        $this->userId    = $userId;
        $this->rate      = $rate;
    }

    public function toArray()
    {
        return [
            'product_id' => $this->productId,
            'user_id'    => $this->userId,
            'rate'       => $this->rate
        ];
    }

}

