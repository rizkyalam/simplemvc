<?php

namespace Core;

class Router
{
    /**
     * List of routes from routes configuration.
     * 
     * @var array
     */
    private $_valid_routes = [];

    /**
     * List of controllers from routes configuration.
     * 
     * @var array
     */
    private $_controller = [];

    /**
     * List of url paramater from request url.
     * 
     * @var array
     */
    private $_params = [];

    /**
     * Insert a new route from routes configuration.
     * 
     * @param $route
     * @param $controller
     */
    public function get($route, $controller)
    {
        $this->_valid_routes[] = [
            'url'    => $route,
            'class'  => $controller[0],
            'method' => $controller[1],
        ];
    }

    /**
     * Parsing the url to be a static or dynamic
     * from request url
     * 
     * @param $request_url
     * @return bool
     */
    private function _parseUrl($request_url)
    {
        $routing = [
            'static'  => false,
            'dynamic' => false,
        ];

        $url = is_null($request_url) ? '' : $this->_urlSplitter($request_url);

        // access static route
        foreach ($this->_valid_routes as $route) {
            $split_route[] = $this->_urlSplitter($route['url']);

            $controller = [
                'class'  => '\App\Controllers\\' . $route['class'],
                'method' => $route['method'],
                'path'   => 'app/controllers/' . $route['class'] . '.php',
            ];

            // access from routes configuration
            if ($url[0] === trim($route['url'], '/')) {
                if (file_exists($controller['path'])) {
                    if (method_exists($controller['class'], $controller['method'])) {
                        $routing['static'] = true;

                        $this->_controller = $controller;

                        return $routing['static'];
                    }
                }
            }
        }

        // access dynamic routes
        $temp_route = null;
        for ($i = 0; $i < count($split_route); $i++) {
            if ($url[0] === $split_route[$i][0]) {
                $temp_route = $split_route[$i];
            }
        }
        if ($temp_route !== null) {
            foreach ($temp_route as $key => $val) {
                // matching routes from curly brackets
                if (preg_match('/^\{(.+)\}$/', $val)) {
                    $this->_params[] = $url[$key];
                    $this->_controller = $controller;
                    $routing['dynamic'] = true;
                }
            }
        }

        return $routing['dynamic'] === true ? true : false;
    }

    /**
     * Spliting the url.
     * 
     * @param $url
     * @return array
     */
    private function _urlSplitter($url)
    {
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

    /**
     * Render the file to browser from route.
     */
    public function render()
    {
        $request_url = isset($_GET['url']) ? $_GET['url'] : null;

        if (is_null($request_url)) {
            // accessing root url
            $root = false;
            
            foreach ($this->_valid_routes as $route) {
                if ($route['url'] === '/') {
                    $root = true;

                    $class = '\App\Controllers\\' . $route['class'];
                    $class = new $class;
                    $class->{$route['method']}();
                }
            }

            if ($root === false) {
                HttpError::notFound();
            }
        } else {
            // access other than root url
            $parsing_url = $this->_parseUrl($request_url);
    
            if ($parsing_url) {
                $class = new $this->_controller['class'];
                $method = $this->_controller['method'];
                
                if (count($this->_params) > 0) {
                    $class->{$method}(...$this->_params);
                } else {
                    $class->{$method}();
                }
    
            } else {
                HttpError::notFound();
            }
        }
    }
}
