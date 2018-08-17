<?php
namespace Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Model\ModelClass\TasklistClass;

class TasklistController
{

    private $request;

    private $response;

    private $tasklistClass;

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        
        return $this->actionRouter();
    }

    public function __construct(TasklistClass $tasklistClass)
    {
        $this->tasklistClass = $tasklistClass;
    }

    private function actionRouter()
    {
        $action = $this->args['action'];
        
        switch ($action) {
            case 'new':
                $this->new();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'list':
                $this->list();
                break;
            case 'delete':
                $this->delete();
                break;
        }
        
        return $this->response;
    }

    private function new()
    {
        $post = $this->request->getParsedBody();
        
        $this->tasklistClass->insert($post);
        
        return $this->sendResponse();
    }

    private function edit()
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

    private function list()
    {
        $taskList = $this->tasklistClass->getAll();
        
        return $this->sendResponse($taskList);
    }

    private function delete()
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

