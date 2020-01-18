<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group;
use Phalcon\Events\Manager as EventsManager;

// Create the router
$router   = new Router(false);
$apiGroup = new Group();
$router->setDI($di);
$apiGroup->setPrefix('/api/v1');

// $router->notFound([ 'controller' => 'error', 'action' => 'error404']);

// Define your routes here
$apiGroup->addGet('/:controller/:params', array(
    "action"     => "index",
    "controller" => 1,
    "params"     => 2,
));

$apiGroup->addGet('/:controller/([0-9]+)/:params', array(
    "action"     => "show",
    "controller" => 1,
    "id"         => 2,
));


$apiGroup->addPut('/:controller/([0-9]+)', array(
    "action"     => "update",
    "controller" => 1,
    "id"         => 2,
));

$apiGroup->addPost('/:controller/([0-9]+)', array(
    "action"     => "store",
    "controller" => 1,
    "id"         => 2,
));

$router->removeExtraSlashes(true);
$router->mount($apiGroup);


$eventsManager = new EventsManager();
$eventsManager->fire('router:beforeCheckRoutes', function(){
    $ControllerBase = new ControllerBase();
    return $ControllerBase->sendJson([], 100);
});
$router->setEventsManager( $eventsManager );

return $router;