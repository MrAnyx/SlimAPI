<?php

use App\Foundation\ControllerRegistration;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

$app = AppFactory::create();
$controllers = include(__DIR__ . "/../controllers.php");

ControllerRegistration::register($app, (array)$controllers);

$app->run();