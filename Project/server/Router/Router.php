<?php

use controller\ScreenActorsController;
use PHP\connection\TMDBController;
use PHP\dbconnection\DatabaseConnector;

include_once './dbconnection/DatabaseConnector.php';
include_once './controller/ScreenActorsController.php';
include_once './connection/TMDBController.php';

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public DatabaseConnector $databaseConnector;
    private PDO $dbConnection;
    private ScreenActorsController $screenActorController;

/*    private array $paramsFromUrl = [];*/

    public function __construct(Request &$request, Response &$response, DatabaseConnector  &$databaseConnector)
    {
        $this->request = $request;
        $this->response = $response;

        $this->databaseConnector = new DatabaseConnector();
        $this->dbConnection = $this->databaseConnector->getConnection();
        $this->screenActorController = new ScreenActorsController($this->dbConnection);
    }

/*    public function get($path, $callback)
    {
        $this->addRoute("GET", $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute("POST", $path, $callback);
    }

    public function put($path, $callback)
    {
        $this->addRoute("PUT", $path, $callback);
    }

    public function delete($path, $callback)
    {
        $this->addRoute("DELETE", $path, $callback);
    }

    public function options($path, $callback)
    {
        $this->addRoute("OPTIONS", $path, $callback);
    }

    private function addRoute(string $method, string $path, $callback)
    {
        array_push($this->routes, new Route($method, $path, $callback));
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function map(string $path, Router $router)
    {
        foreach ($router->getRoutes() as $route) {
            $this->addRoute($route->getMethod(), $path . $route->getPath(), $route->getCallback());
        }
    }

    public function resolve()
    {
        if (!is_array($this->routes) || empty($this->routes)) {
            $this->sendInternalServerError("NON Object route set");
            return;
        }

        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $filteredRoutes = $this->filterRoutesByMethod($this->routes, $method);

        $filteredRoutes = $this->filterRoutesByPath($filteredRoutes, $path);

        if (!$filteredRoutes || empty($filteredRoutes)) {
            $this->requestNotFound();
        } else {
            if (count($filteredRoutes) !== 1)
                $this->sendInternalServerError("Multiple routes for $path.");
            else {
                $requestRoute = $filteredRoutes[0];
                if (is_callable($requestRoute->getCallback())) {
                    call_user_func_array($requestRoute->getCallback(), [&$this->request, &$this->response, $this->paramsFromUrl]);
                } else {
                    $this->runController($requestRoute->getCallback());
                }
            }
        }

        $this->response->render();
    }

    public function runController(string $controller)
    {
        $parts = explode('@', $controller);
        $file = CONTROLLERS . ucfirst($parts[0]) . '.php';

        if (file_exists($file)) {
            require_once($file);

            $controllerName = ucfirst($parts[0]);

            if (class_exists($controllerName)) {
                $fileController = new $controllerName($this->request, $this->response);

                if (isset($parts[1]) && $parts[1] !== "") {
                    $method = $parts[1];

                    if (method_exists($fileController, $method)) {
                        if (is_callable([$fileController, $method])) {
                            call_user_func([$fileController, $method], $this->paramsFromUrl);
                        } else
                            $this->requestControllerError($parts[0], $parts[1], "method is not callable.");
                    } else
                        $this->requestControllerError($parts[0], $parts[1], "method does not exists.");
                } else
                    $this->requestControllerError($parts[0], $parts[1], "method is not set.");
            } else
                $this->requestControllerError($parts[0], $parts[1], "class for controller does not exists.");
        } else
            $this->requestControllerError($parts[0], $parts[1], "file for controller does not exists.");
    }

    public function filterRoutesByMethod(array $routesToFilter, string $method): array
    {
        $result = [];
        foreach ($routesToFilter as $route) {
            if ($route->getMethod() === $method) {
                array_push($result, $route);
            }
        }
        return $result;
    }

    public function filterRoutesByPath(array $routesToFilter, string $path): array
    {
        $result = [];
        foreach ($routesToFilter as $route) {
//            if ($route->getPath() === $path) {
            if ($this->isMatchingRouteParameters($path, $route)) {
                array_push($result, $route);
            }
        }
        return $result;
    }

    public function requestNotFound()
    {
        $this->response->setStatusCode(404);
        $this->response->setContent(["message" => "not found"]);
    }

    public function requestControllerError(string $controllerName, string $methodName, string $errorMessage)
    {
        $this->response->setStatusCode(500);
        $this->response->setContent(["message" => "ERROR => Method '$methodName' in the '$controllerName': " . $errorMessage]);
    }

    public function sendInternalServerError($message)
    {
        $this->response->setStatusCode(500);
        $this->response->setContent(["message" => $message]);
    }

    public function isMatchingRouteParameters(string $url, Route $route): bool
    {
        $routeRegex = $route->getRoutePatternRegex();

        if (preg_match($routeRegex, $url, $paramsValuesFromUrl)) {
            $paramsNamesFromRoute = $route->getVariadicParametersArray();

            foreach ($paramsNamesFromRoute as $value) {
                if (isset($paramsValuesFromUrl[$value])) {
                    $this->paramsFromUrl[$value] = $paramsValuesFromUrl[$value];
                }
            }
            return true;
        }
        return false;
    }*/

}