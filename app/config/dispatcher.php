<?php

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;

$dispatcher    = new Dispatcher();
$eventsManager = new EventsManager;

$eventsManager->attach('dispatch:beforeExecuteRoute',
    function (Event $event) use($dispatcher, $userId) {

        $request  = new Phalcon\Http\Request();
        $response = new Phalcon\Http\Response();
        $userId   = $request->getHeader('userId');

        if($userId == 1) {
            $response->setStatusCode(401);
            $response->setContentType('application/json');
            $response->setJsonContent(['message' => 'Unauthorized']);
            $response->send();
            return false;
        }
    }
);
$dispatcher->setEventsManager($eventsManager);
return $dispatcher;