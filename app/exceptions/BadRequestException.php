<?php

namespace App\Exceptions;

use Phalcon\Http\Response;

class BadRequestException
{
    public function __construct($message = "Bad Request")
    {
        $this->handle($message);
    }

    public function handle($message)
    {
        $response = new Response();
        $response->setStatusCode(400);
        $response->setContentType('application/json');
        $response->setJsonContent(['message' => $message]);
        $response->send();
        return $false;
    }
}
