<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function handleSuccessResponse($message, $statusCode = 200)
    {
        return $this->jsonResponse(['message' => $message], $statusCode);
    }

    public function jsonResponse($data, $statusCode) 
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setStatusCode($statusCode);
        $this->response->setContent(json_encode($data));
        $this->response->send();
        return false;
    }
}
