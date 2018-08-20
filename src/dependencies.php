<?php
use Zend\Db\Adapter\AdapterInterface;
use Controller\TasklistController;
use Model\TaskListModel;
use Model\ModelClass\TasklistClass;
use Model\ModelClass\TaskDescriptionClass;
use Model\TaskDescriptionModel;

// DIC configuration
$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Zend DB
$container[AdapterInterface::class] = function ($c) {
    $settings = $c->get('settings')['db'];
    $adapter = new Zend\Db\Adapter\Adapter($settings);
    return $adapter;
};

// Model
$container[TaskListModel::class] = function ($c) {
    return new TaskListModel($c->get(AdapterInterface::class));
};

$container[TaskDescriptionModel::class] = function ($c) {
    return new TaskDescriptionModel($c->get(AdapterInterface::class));    
};

// Class
$container[TasklistClass::class] = function ($c) {
    return new TasklistClass($c->get(TaskListModel::class));
};

$continer[TaskDescriptionClass::class] = function ($c) {
    return new TaskDescriptionClass($c->get(TaskDescriptionModel::class));  
};
    
// Controller
$container[TasklistController::class] = function ($c) {
    return new TasklistController($c->get(TasklistClass::class), $c->get(TaskDescriptionClass::class));
};
