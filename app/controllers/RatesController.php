<?php

use App\Models\Rates;
use App\Models\Products;

class RatesController extends ControllerBase
{

    public function storeAction()
    {
        $userId    = $this->request->getHeader('userId');
        $productId = $this->dispatcher->getParam('id');

        $product = Products::findFirst([
            'conditions' => "id = $productId",
        ]);

        if($product->user_id == $userId) {
            return $this->sendJson([
                'message' => "you can't rate your product"
            ], 400);
        }


        $rate  = new Rates();
        $saved = $rate->save([
            'rate'       => 4,
            'product_id' => $productId,
            'user_id'    => $userId
        ]);

        if (false === $saved) {

            $messages = $rate->getMessages();
        
            foreach ($messages as $message) 
            {
                $error['message'] = $message->getMessage();
                $error['field']   = $message->getField();
                $error['type']    = $message->getType();
            }
        }

        // if(!$updated)
        //     return $this->notFoundResponse();

        return $this->sendJson($error);
    }

}

