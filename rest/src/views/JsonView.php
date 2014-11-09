<?php
namespace TcRest\views;
class JsonView extends BaseView {
   
    public function __construct($args) {
        parent::__construct($args);
    }
    public function render($args){
        if(!headers_sent()){
            header("Access-Control-Allow-Orgin: *");
            header("Access-Control-Allow-Methods: *");
            header("Content-Type: application/json");
        }
        $output = json_encode($args);
        echo $output;
        return $output;
    }
}