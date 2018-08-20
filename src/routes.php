<?php

use Controller\TasklistController;
use Middleware\Middleware;

$app->post('/{controller}/{action}', TasklistController::class)->add(new Middleware());

$app->get('/{controller}/{action}', TasklistController::class)->add(new Middleware());

$app->post('/{controller}/{action}/{id}', TasklistController::class)->add(new Middleware());

$app->get('/{controller}/{action}/{id}', TasklistController::class)->add(new Middleware());



