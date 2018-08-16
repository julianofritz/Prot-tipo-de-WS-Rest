<?php

use src\Controller\TasklistController;
use src\Middleware\Middleware;

$app->get('new', TasklistController::class)->add(new Middleware());
