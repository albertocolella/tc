<?php
namespace TcRest\models;
abstract class BaseModel {
    protected $db;
    protected function __construct(){
        $this->db = $GLOBALS['DB'];
    }
    abstract function save($args);
    abstract function load($args);
    abstract function delete($args);    
    public function loadAll() {}
    protected function getDb() {
        return $this->db;
    }     
}