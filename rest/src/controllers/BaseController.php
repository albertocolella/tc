<?php
namespace TcRest\controllers;
abstract class BaseController {
    protected $args = Array();
    
    public function __construct($args) {
        $this->args = $args;
    }
    abstract public function get($args);
    abstract public function post($args);
    abstract public function put($args);
    abstract public function delete($args);    
}