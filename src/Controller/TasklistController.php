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
    {}

    private function edit()
    {}

    private function list()
    {}

    private function delete()
    {}
    

}

