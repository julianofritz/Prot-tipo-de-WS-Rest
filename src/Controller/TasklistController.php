<?php
namespace Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Model\ModelClass\TasklistClass;
use Model\ModelClass\TaskDescriptionClass;

class TasklistController
{

    private $request;

    private $response;

    private $tasklistClass;
    
    private $taskDescriptionClass;

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        
        return $this->ControllerRouter();
    }

    public function __construct(TasklistClass $tasklistClass, TaskDescriptionClass $taskDescriptionClass)
    {
        $this->tasklistClass        = $tasklistClass;
        
        $this->taskDescriptionClass = $taskDescriptionClass;
    }
    
    private function ControllerRouter()
    {
        $controller = $this->args['controller'];
        
        switch ($controller) {
            case 'tasklist':
                $response = $this->taskListRouter();
                break;
            case 'taskdescription':
                $response = $this->taskDescriptionRouter();
                break;
        }
        
        return $response;
    }

    private function taskListRouter()
    {
        $action = $this->args['action'];
        
        switch ($action) {
            case 'new':
                $response = $this->newTaskList();
                break;
            case 'edit':
                $response = $this->editTaskList();
                break;
            case 'list':
                $response = $this->listTaskList();
                break;
            case 'delete':
                $response = $this->deleteTaskList();
                break;
        }
        
        return $response;
    }
    
    private function taskDescriptionRouter()
    {
        $action = $this->args['action'];
        
        switch ($action) {
            case 'new':
                $response = $this->newTaskDescription();
                break;
            case 'edit':
                $response = $this->editTaskDescription();
                break;
            case 'list':
                $response = $this->listTaskDescription();
                break;
            case 'delete':
                $response = $this->deleteTaskDescription();
                break;
        }
        
        return $response;
    }

    private function newTaskList()
    {
        $post = $this->request->getParsedBody();
        
        $this->tasklistClass->insert($post);
        
        return $this->sendResponse();
    }

    private function editTaskList()
    {
        $id = $this->args['id'];
        
        $isPost = $this->request->isPost();
        
        if (! $isPost) {
            $taskData = $this->tasklistClass->get($id);
            
            return $this->sendResponse($taskData);
        }
        
        $post = $this->request->getParsedBody();
        
        $this->tasklistClass->update($post, $id);
    }

    private function listTaskList()
    {
        $taskList = $this->tasklistClass->getAll();
        
        return $this->sendResponse($taskList);
    }

    private function deleteTaskList()
    {}
    
    private function newTaskDescription()
    {
        $id = $this->args['id'];
        
        $post = $this->request->getParsedBody();
        
        $this->taskDescriptionClass->insert($post);
        
        return $this->sendResponse();
    }
    
    private function editTaskDescription()
    {}
    
    private function listTaskDescription()
    {
    }
    
    private function deleteTaskDescription()
    {}
    
    private function sendResponse($data = false)
    {
        $httpStatus = $this->response->withStatus(200,'Ação executada com sucesso');
        
        if(!$data) {
            return $this->response;
        }
        
        $jsonData = json_encode($data);
        
        $newResponse = $this->response->withJson($jsonData);
        
        return $newResponse;
    }
}

