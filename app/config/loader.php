<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
    ]
)
->registerNamespaces([
    'App\Models'       => dirname(__DIR__).'/models/',
    'App\Transformers' => dirname(__DIR__).'/transformers/',
    'App\Exceptions'   => dirname(__DIR__).'/exceptions/',
    'App\Services'     => dirname(__DIR__).'/services/',
])
->register();
