<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Repositories\ProductRepository;
use App\Exceptions\ValidationException;
use App\Exceptions\NotFoundException;

class ProductService {

    private $productRepository;
    
    public function __construct() 
    {
        $this->productRepository = new ProductRepository();
    }

    public function getProductById($productId)
    {
        $product = $this->productRepository->getById($productId);

        if(!$product)
            throw new NotFoundException("Product not found");

        return $product;
    }

    public function getProducts($code)
    {
        return $this->productRepository->filter($code);
    }

    public function updateProduct(ProductDTO $productDTO)
    {
        $updated = $this->productRepository->updateByProductIdUserId(
            $productDTO->productId, 
            $productDTO->userId, 
            $productDTO->toArray()
        );

        if($updated === false)
            throw new NotFoundException("Product not found");

        return $updated;
    }
    

}

