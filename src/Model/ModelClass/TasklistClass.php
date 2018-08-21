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

    public function insert(array $formData)
    {
        $formattedData = $this->prepareData($formData, true);

        $id = $this->model->insertTask($formattedData);
        
        if (! $id) {
            return false;
        }
        
        return $id;
    }

    public function get(int $id)
    {
        $data = $this->model->getTask($id);
        
        return $data;
    }

    public function getAll()
    {
        $list = $this->model->getAllTasks();
        
        return $list;
    }

    public function update(array $data, int $id)
    {
        $formattedData = $this->prepareData($data);
        
        $result = $this->model->updateTask($formattedData, $id);
    }

    private function prepareData(array $formData, $isInsert = false)
    {
        $data = [
            'tsk_title' => $formData['tsk_title'],
            'tks_id' => $formData['tks_id']
        ];
        
        return $data;
    }
}

