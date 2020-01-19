<?php

namespace App\Exceptions;

use Phalcon\Http\Response;
use Phalcon\Exception;

class ValidationException
{
    public function __construct($messages)
    {
        $this->handle($messages);
    }

    public function handle($messages)
    {
        $errorss = [];

        foreach ($messages as $message) {
            $errorss[] = $message->getMessage();
        }
    
        $response = new Response();
        $response->setStatusCode(422);
        $response->setContentType('application/json');
        $response->setJsonContent([
            'message' => 'invalid data',
            'erros'   => $errorss,
        ]);
        $response->send();
        return false;
    }
}
