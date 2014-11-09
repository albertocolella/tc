<?php

namespace TcRest;
require 'vendor/autoload.php';
use TcRest\lib\Router;

class Server
{
    protected $routes = array();
    protected $router = null;
    
    public function __construct($routes = array(), $settings = array())
    {
        $this->routes = $routes;
        $this->settings = $this->parseSettings($settings);
        $GLOBALS['DB'] = new $this->settings['adapter']['class']($this->settings['adapter']);
        $this->router = new Router($this->routes);
    }
    
    public function route()
    {        
        return $this->router->callRoute();
    }
    
    private function parseSettings($settings){
        $defaults = array(
            'adapter' => array(
                'class' => 'TcRest\lib\adapters\Csv',
                'source' => dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'adapters'.DIRECTORY_SEPARATOR.'example.csv'
            )
        );
        return array_replace_recursive($defaults, $settings);
    }
    
    
}