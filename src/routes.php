<?php

use Controller\TasklistController;
use Middleware\Middleware;

$app->post('/{action}', TasklistController::class)->add(new Middleware());

$app->get('/{action}', TasklistController::class)->add(new Middleware());

$app->post('/{action}/{id}', TasklistController::class)->add(new Middleware());

$app->get('/{action}/{id}', TasklistController::class)->add(new Middleware());



