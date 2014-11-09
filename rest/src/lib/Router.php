<?php

namespace TcRest\lib;

class Router {
    private $routes;
    
    public function __construct($routes) {
        $this->routes = $routes;
    }
    
    function callRoute(){
        $path = $this->getPath();
        $path = explode('/', $path);            
        $controller_info = $this->getController(array_shift($path));
        $c = $controller_info['controller'];
        if (!isset($_SERVER['HTTP_ORIGIN']) && isset($_SERVER['SERVER_NAME'])) {
            $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
        }
        try {
            $method = $this->getMethod();
            $request = $this->getRequest($method);
            $ctr = new $c($request);
            return call_user_func(array(&$ctr, strtolower($method)), $path);
        } catch (Exception $e) {
            return json_encode(Array('error' => $e->getMessage()));
        }
    }
    
    function getRequest($method){
        switch($method){
            case 'GET':
                return $_GET;
            case 'POST':
                return $_POST;
            case 'DELETE':
            case 'PUT':
                $post_vars = array();
                parse_str(file_get_contents("php://input"),$post_vars);
                $_REQUEST = $post_vars + $_REQUEST;
                return $_REQUEST;
            default:
                header("HTTP/1.1 405");
                return json_encode('Error: Method not supported');            
        }
    }
    
    function getMethod(){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD'])) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
        return $method;
    }
    
    function getController($path){
        if(isset($this->routes[$path])){
            return $this->routes[$path];
        }
        return false;
    }
    
    function getPath(){
        $path_info = '';
        if(!empty($_SERVER['PATH_INFO'])){
            $path_info = $_SERVER['PATH_INFO'];
        } else if(!empty($_SERVER['ORIG_PATH_INFO'])){
            $path_info = $_SERVER['ORIG_PATH_INFO'];
        }
        return ltrim($path_info,'/');
    }
    
}
