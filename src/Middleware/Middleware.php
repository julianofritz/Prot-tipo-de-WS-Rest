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
        
        $result = $this->findRoute($uri);
        
        if (!$result['status']) {
            return $response = $response->withStatus($result['code'])->write($result['message']);
        }
        
        $response = $next($request, $response);
        
        return $response;
    }
    
    private function findRoute(string $uri)
    {
        $this->_arrayUri = explode('/', $uri);
        $action = $this->_arrayUri[1];
        
        switch ($action) {
            case 'new':
                $return = ['status' => true];
                break;
            case 'edit':
                $return = $this->validateTasklistId();
                break;
            case 'list':
                $return = ['status' => true];
                break;
            case 'delete':
                $return = $this->validateTasklistId();
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
    
    private function validateTasklistId()
    {
        $return = ['status' => true];
        
        $id = $this->_arrayUri[2];
        
        $result = $this->validateInteger($id);
        
        if (!$result) {
            $return = [
                'status' => false,
                'message' => 'Código da task no formato inválido',
                'code' => 401
            ];
        }
        
        return $return;
    }
    
    private function validateInteger($number)
    {
        $return = filter_var($number, FILTER_VALIDATE_INT);
        
        if (!$return) {
            return false;
        }
        
        return $number;
    }
    
}

