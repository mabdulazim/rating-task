<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function successfulUdatingResponse()
    {
        $data = [
            'message' => 'updated successfuly'
        ];
        return $this->sendJson($data, 200);
    }

    public function notFoundResponse()
    {
        $data = [
            'message' => 'product not found'
        ];
        return $this->sendJson($data, 404);
    }

    public function sendJson($data, $statusCode = 200) {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setStatusCode($statusCode);
        $this->response->setContent(json_encode($data));
        return $this->response;
    }
}
