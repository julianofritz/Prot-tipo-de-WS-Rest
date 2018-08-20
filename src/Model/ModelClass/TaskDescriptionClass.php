<?php
namespace Model\ModelClass;

use Model\TaskDescriptionModel;

class TaskDescriptionClass
{
    private $model;
    
    public function __construct(TaskDescriptionModel $model)
    {
        $this->model = $model;
    }
    
    public function insert(array $formData)
    {
        $formattedData = $this->prepareData($formData);
        
        $id = $this->model->insertTaskDescription($formattedData);
        
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
        $formattedData = $this->prepareData($data);
        
        $result = $this->model->updateTaskDescription($formattedData, $id);
    }
    
    private function prepareData(array $formData)
    {
        $data = [
            'tkd_description' => $formData['tkd_description'],
        ];
        
        return $data;
    }
}

