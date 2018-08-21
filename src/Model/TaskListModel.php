<?php
namespace Model;

class TaskListModel extends AbstractModel
{

    public function insertTask(array $data)
    {
        $sql = $this->insert()->into('task_list');
        
        $sql->values($data);
        
        $result = $this->execute($sql);
        return $result->getGeneratedValue();
    }

    public function getAllTasks()
    {
        $sql = $this->select()->from([
            'tsk' => 'task_list'
        ])
        ->columns([
            'tsk_id',
            'tsk_title',
        ])
        ->join(['tks' => 'task_status'], 'tks.tks_id = tsk.tks_id', ['tks_name', 'tks_id']);
        
        $dados = $this->fetchAll($sql);
        
        return $dados;
    }
    
    public function getTask(int $id)
    {
        $sql = $this->select()->from(['tsk' => 'task_list'])
        ->columns([
            'tsk_id',
            'tsk_title',
            'tks_id'
        ])
        ->where([
            'tsk_id' => $id
        ]);
        
        $dados = $this->fetchRow($sql);
        
        return $dados;
    }

    public function updateTask(array $data, int $id)
    {
        $sql = $this->update('task_list');
        $sql->set($data);
        $sql->where([
            'tsk_id' => $id
        ]);
        
        $result = $this->execute($sql);
        return $result->getGeneratedValue();
    }
}

