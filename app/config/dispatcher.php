<?php

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use App\Services\UserService;

$dispatcher    = new Dispatcher();
$eventsManager = new EventsManager;
$request       = new Request();
$userService   = new UserService();

$eventsManager->attach('dispatch:beforeExecuteRoute', function () use($request, $userService) 
{
    $userId = $request->getHeader('userId');

    if(!$userId || !$userService->isUserExist($userId)) {
        $response = new Response();
        $response->setStatusCode($exception->getCode());
        $response->setContentType('application/json');
        $response->setJsonContent(['message' => 'Unauthorized']);
        $response->send();
        return false;
    }
});

$eventsManager->attach('dispatch:beforeException', function ($event, Dispatcher $dispatcher, $exception)
{
    if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
        $response = new Response();
        $response->setStatusCode($exception->getCode());
        $response->setContentType('application/json');
        $response->setJsonContent(['message' => $exception->getMessage()]);
        $response->send();
        return false;
    }
});

$dispatcher->setEventsManager($eventsManager);
return $dispatcher;