<?php
namespace Model\ModelClass;

use Model\TaskDescriptionModel;
use Model\TaskListModel;

class TaskDescriptionClass
{

    private $model;
    
    private $taskListModel;

    public function __construct(TaskDescriptionModel $model, TaskListModel $taskListModel)
    {
        $this->model = $model;
        
        $this->taskListModel = $taskListModel;
    }

    public function insert(array $formData)
    {        
        $id = $this->model->insertTaskDescription($formData);
        
        if (! $id) {
            return false;
        }
        
        return $id;
    }

    public function get(int $id)
    {
        $data = $this->model->getTaskDescription($id);
        
        return $data;
    }

    public function getAll(int $taskId)
    {
        $list = $this->model->getAllTaskDescriptions($taskId);
        
        return $list;
    }

    public function update(array $data, int $id)
    {
        
        $result = $this->model->updateTaskDescription($data, $id);
    }

    private function prepareData(array $formData)
    {
        $data = [
            'tkd_description' => $formData['tkd_description']
        ];
        
        return $data;
    }
}

