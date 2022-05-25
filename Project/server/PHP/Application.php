<?php

class Application
{
    public Router $router;
    public Response $response;
    public Request $request;

    public function __construct(Response &$response, Request &$request) {
        $databaseConnector = &$databaseConnector;
        $this->response = &$response;
        $this->request = &$request;
        $this->router = new Router($this->request, $this->response);
    }

}