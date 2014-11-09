<?php

namespace TcRest\lib\adapters;

class Csv implements Adapter {
    protected $file;
    protected $rows;
    protected $mapping = array();
    private $loaded = false;
    static $db_type = 'csv';
    
    public function __construct($settings){
        $this->file = $settings['source'];
    }
    
    protected function load(){
        $file = fopen($this->file, 'r');
        $this->rows = array();
        while (($line = fgetcsv($file)) !== FALSE) {            
            $this->rows[] = $this->mapping($line);
        }
        fclose($file);
    }
    
    public function insert($args){
        
    }
    
    public function update($args){
    
    }
    
    public function find($where=array(), $options=array()){
        if(!$this->loaded){
            $this->load();
            $this->loaded = true;
        }
        if(isset($where['id'])){
            return $this->rows[$where['id']];
        }
        return $this->rows;
    }
    
    public function delete($args){

    }
    
    protected function mapping($item){
        $res = array();
        foreach($item as $pos=>$value){
            $res[$this->mapping[$pos]] = $value;
        }
        return (object)$res;
    }
    
    public function setMapping($mapping){
        $this->mapping = $mapping;
    }
}