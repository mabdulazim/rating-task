<?php

namespace App\Exceptions;

use Phalcon\Http\Response;

class NotFoundException
{
    public function __construct()
    {
        $this->handle();
    }

    public function handle()
    {
        $response = new Response();
        $response->setStatusCode(404);
        $response->setContentType('application/json');
        $response->setJsonContent(['message' => 'Not found']);
        $response->send();
        return $false;
    }
}
