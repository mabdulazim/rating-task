<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Repositories\ProductRepository;
use App\Exceptions\ValidationException;

class ProductService {

    private $productRepository;
    
    public function __construct() 
    {
        $this->productRepository = new ProductRepository();
    }

    public function getProductById($productId)
    {
        return $this->productRepository->getById($productId);
    }

    public function getProducts($code)
    {
        return $this->productRepository->filter($code);
    }

    public function updateProduct(ProductDTO $productDTO)
    {
        return $this->productRepository->updateByProductIdUserId(
            $productDTO->productId, 
            $productDTO->userId, 
            $productDTO->toArray()
        );
    }
    

}

