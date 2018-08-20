<?php
namespace Model;

class TaskDescriptionModel extends AbstractModel
{
    public function insertTaskDescription(array $data)
    {
        $sql = $this->insert()->into('task_description');
        
        $sql->values($data);
        
        $result = $this->execute($sql);
        return $result->getGeneratedValue();
    }
    
    public function getAllTaskDescriptions(int $taskId)
    {
        $sql = $this->select()->from([
            'tkd' => 'task_description'
        ])
        ->join(['tsk' => 'task_list'], 'tsk.tsk_id = tkd.tsk_id')
        ->columns([
            'tkd_id',
            'tkd_description'
        ])
        ->where([
            'tkd.tsk_id' => $taskId
        ]);
        
        $dados = $this->fetchAll($sql);
        
        return $dados;
    }
    
    public function getTaskDescription(int $id)
    {
        $sql = $this->select()->from(['tkd' => 'task_description'])
        ->columns([
            'tkd_id',
            'tkd_description'
        ])
        ->where([
            'tkd_id' => $id
        ]);
        
        $dados = $this->fetchRow($sql);
        
        return $dados;
    }
    
    public function updateTaskDescription(array $data, int $id)
    {
        $sql = $this->update('task_description');
        $sql->set($data);
        $sql->where([
            'tkd_id' => $id
        ]);
        
        $result = $this->execute($sql);
        return $result->getGeneratedValue();
    }
}

