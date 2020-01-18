<?php

use App\Models\Rates;

class RatesController extends ControllerBase
{

    public function storeAction()
    {
        $userId    = $this->request->getHeader('userId');
        $productId = $this->dispatcher->getParam('id');

        $rate  = new Rates();
        $saved = $rate->save([
            'rate'       => $this->request->getPost('rate', 'int'),
            'product_id' => $productId,
            'user_id'    => $userId
        ]);

        // if(!$updated)
        //     return $this->notFoundResponse();

        return $this->sendJson([]);
    }

}

