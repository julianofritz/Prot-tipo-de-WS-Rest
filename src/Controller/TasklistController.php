<?php
namespace src\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class TasklistController
{

    private $request;

    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function new()
    {}

    public function edit()
    {}

    public function list()
    {}

    public function delete()
    {}
}

