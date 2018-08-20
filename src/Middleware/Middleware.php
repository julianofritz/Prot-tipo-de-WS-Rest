<?php
namespace Middleware;
use Slim\Http\Request;
use Slim\Http\Response;

class Middleware
{
    private $_arrayUri;
    
    public function __invoke(Request $request, Response $response, $next)
    {
        $uri = $request->getUri()->getPath();
        
        $result = $this->validateController($uri);
        
        if (!$result['status']) {
            return $response = $response->withStatus($result['code'])->write($result['message']);
        }
        
        $result = $this->validateAction($uri);
        
        if (!$result['status']) {
            return $response = $response->withStatus($result['code'])->write($result['message']);
        }
        
        $response = $next($request, $response);
        
        return $response;
    }
    
    private function validateController(string $uri)
    {
        $this->_arrayUri = explode('/', $uri);
        $controller = $this->_arrayUri[1];
        
        switch ($controller) {
            case 'tasklist':
            case 'taskdescription':
                $return = ['status' => true];
                break;
            default:
                $return = [
                'status' => false,
                'message' => 'Requisição desconhecida, o método não existe',
                'code' => 404
                ];
        }
        
        return $return;
    }
    
    private function validateAction(string $uri)
    {
        $this->_arrayUri = explode('/', $uri);
        $action = $this->_arrayUri[2];
        
        switch ($action) {
            case 'new':
            case 'edit':
            case 'list':
            case 'delete':
                $return = ['status' => true];
                break;
            default:
                $return = [
                'status' => false,
                'message' => 'Requisição desconhecida, o método não existe',
                'code' => 404
                ];
        }
        
        return $return;
    }
        
}

