<?php

namespace App\Services;

use App\DTOs\RateDTO;
use App\Services\ProductService;
use App\Repositories\RateRepository;
use App\Exceptions\BadRequestException;
use App\Exceptions\ValidationException;

class RateService {

    private $rateRepository;
    private $productService;

    public function __construct() 
    {
        $this->rateRepository = new RateRepository();
        $this->productService = new ProductService();
    }

    public function addRate(RateDTO $rateDTO)
    {
        // GET PRODUCT BY ID
        $product = $this->productService->getProductById($rateDTO->productId);

        // CHECK IF PRODUCT DOESN'T BELONGS TO CURRENT USER
        if($product->user_id == $rateDTO->userId)
            throw new BadRequestException("you can't rate your product");

        // ADD RATE TO DATABASE
        $rate = $this->rateRepository->create($rateDTO->toArray());

        // CHECK VALIDATIONS
        if($rate->getMessages())
            throw new ValidationException($rate->getMessages());

        return true;
    }
    

}

