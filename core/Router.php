<?php

namespace Core;

class Router
{
    private $valid_routes = [];
    private $controller;
    private $params = [];

    public function get($route, $controller)
    {
        $this->valid_routes[] = [
            'url'    => $route,
            'class'  => $controller[0],
            'method' => $controller[1],
        ];
    }

    private function _parseUrl($request_url)
    {
        $routing = [
            'static'  => false,
            'dynamic' => false,
        ];

        $url = is_null($request_url) ? '' : $this->_urlSplitter($request_url);

        // access static route
        foreach ($this->valid_routes as $route) {
            $split_route[] = $this->_urlSplitter($route['url']);

            $controller = [
                'class'  => '\App\Controller\\' . $route['class'],
                'method' => $route['method'],
                'path'   => 'app/controllers/' . $route['class'] . '.php',
            ];

            // access from routes configuration
            if ($url[0] === trim($route['url'], '/')) {
                if (file_exists($controller['path'])) {
                    require_once $controller['path'];

                    if (method_exists($controller['class'], $controller['method'])) {
                        $routing['static'] = true;

                        $this->controller = $controller;

                        return $routing['static'];
                    }
                }
            }

            // access from public directory
            if (file_exists('public/' . $request_url)) {
                return require_once 'public/' . $request_url;
            }
        }

        // access dynamic routes
        for ($i = 0; $i < count($split_route); $i++) {
            if ($url[0] === $split_route[$i][0]) {
                $temp_route = $split_route[$i];
            }
        }
        foreach ($temp_route as $key => $val) {
            // matching routes from curly bracket
            if (preg_match('/^\{(.+)\}$/', $val)) {
                $this->params[] = $url[$key];
                $this->controller = $controller;
                $routing['dynamic'] = true;
            }
        }

        return $routing['dynamic'] === true ? true : false;
    }

    private function _urlSplitter($url)
    {
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

    private function _setParams($params)
    {
        $this->params = $params;
    }

    public function renderFile()
    {
        $request_url = $_GET['url'];
        $parsing_url = $this->_parseUrl($request_url);

        
        if ($parsing_url) {
            require_once $this->controller['path'];

            $class = new $this->controller['class'];
            $method = $this->controller['method'];
            
            if (count($this->params) > 0) {
                call_user_func_array([$class, $method], $this->params);
            }

            $class->{$method}();
        } else {
            HttpError::notFound();
        }
    }
}