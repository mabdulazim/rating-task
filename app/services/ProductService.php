<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Repositories\ProductRepository;
use \Phalcon\Mvc\Dispatcher\Exception;

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
            throw new Exception("product not found", 404);

        return $product;
    }

    public function getProducts($code)
    {
        return $this->productRepository->filter($code);
    }

    public function updateProduct(ProductDTO $productDTO)
    {
        $product = $this->productRepository->updateByProductIdUserId(
            $productDTO->productId, 
            $productDTO->userId, 
            $productDTO->toArray()
        );

        // CHECK VALIDATIONS
        if($product && $product->getMessages())
            throw new Exception($product->getMessages()[0]->getMessage(), 400);

        if($product === false)
            throw new Exception("product not found", 404);

        return true;
    }
    

}

