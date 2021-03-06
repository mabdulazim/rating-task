<?php

use App\DTOs\RateDTO;
use App\Services\RateService;

class RatesController extends ControllerBase
{
    public function storeAction()
    {        
        // CREATE DATA TRANSFER OBJECT
        $rateDTO = new RateDTO(
            $this->dispatcher->getParam('id'),
            $this->request->getHeader('userId'),
            $this->request->getJsonRawBody(true)['rate']
        );

        // PASS DTO TO ADD RATE SERVICE
        $rateService = new RateService();
        $rateService->addRate($rateDTO);

        // RETURN SUCCESSFULL RESPONSE
        $this->handleSuccessResponse("Rated successfully", 200);
    }

}

