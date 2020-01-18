<?php

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Request;
use App\Exceptions\UnauthorizedException;
use App\Services\UserService;

$dispatcher    = new Dispatcher();
$eventsManager = new EventsManager;
$request       = new Request();
$userService   = new UserService();

$eventsManager->attach('dispatch:beforeExecuteRoute', function () use($request, $userService) 
{
    $userId = $request->getHeader('userId');

    if(!$userId || !$userService->isUserExist($userId)) {
        throw new UnauthorizedException();
    }
});

$dispatcher->setEventsManager($eventsManager);
return $dispatcher;