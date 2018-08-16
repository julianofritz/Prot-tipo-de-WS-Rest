<?php
namespace Model\ModelClass;

use Model\TaskListModel;

class TasklistClass
{
    
    private $model;
    
    public function __construct(TaskListModel $model)
    {
        $this->model = $model;
    }
    
}

