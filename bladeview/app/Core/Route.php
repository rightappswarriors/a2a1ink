<?php

namespace App\Core;

use Exception;

class Route
{
    protected array $routes = [];

    protected function notFound(): void
    {
        http_response_code(404);
        echo "Page not found";
    }
    
    public function get(string $uri, $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $basePath = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        if ($basePath !== '' && $basePath !== '/' && str_starts_with($requestUri, $basePath)) 
        {
            $requestUri = substr($requestUri, strlen($basePath));
        }
        $requestUri = '/' . trim($requestUri, '/');

        if (!isset($this->routes[$method])) 
        {
            $this->notFound();
            return;
        }

        foreach ($this->routes[$method] as $route => $action) 
        {
            
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $requestUri, $matches)) 
            {
                array_shift($matches);

                if(is_callable($action))
                {
                    call_user_func_array($action, $matches);
                    return;
                }

                if(is_array($action))
                {
                    [$class, $methodName] = $action;

                    if (!class_exists($class)) {
                        http_response_code(500);
                        echo "Controller {$class} not found";
                        return;
                    }

                    $controller = new $class();

                    if (!method_exists($controller, $methodName)) 
                    {
                        http_response_code(500);
                        echo "Method {$methodName} not found in {$class}";
                        return;
                    }

                    call_user_func_array([$controller, $methodName], $matches);
                    return;
                }
                
            }
        }

        $this->notFound();
    }

}