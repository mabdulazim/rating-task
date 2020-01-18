<?php

namespace App\Exceptions;

use Phalcon\Http\Response;

class BadRequestException
{
    public function __construct()
    {
        $this->handle();
    }

    public function handle()
    {
        $response = new Response();
        $response->setStatusCode(401);
        $response->setContentType('application/json');
        $response->setJsonContent(['message' => 'Unauthorized']);
        $response->send();
        return $false;
    }
}
