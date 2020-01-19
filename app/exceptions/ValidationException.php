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
        $errors = [];

        foreach ($messages as $message) {
            $errors[] = $message->getMessage();
        }
    
        $response = new Response();
        $response->setStatusCode(422);
        $response->setContentType('application/json');
        $response->setJsonContent([
            'message' => 'invalid data',
            'erros'   => $errors,
        ]);
        $response->send();
        return false;
    }
}
