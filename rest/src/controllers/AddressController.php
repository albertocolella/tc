<?php
namespace TcRest\controllers;
use TcRest\models\AddressModel;

class AddressController extends BaseController{
    protected $view;
    
    public function __construct($args) {
        parent::__construct($args);
        $this->view = new \TcRest\views\JsonView($args);
    }
    
    function get($request){
        if(empty($request)){
            $a = new AddressModel();
            return $this->view->render($a->loadAll());
        }
        $id = $request[0];
        $a = new AddressModel($id);
        return $this->view->render($a);
    }
    function post($request){
        $this->view->render("AddressController#post");
    }
    function put($request){
        $this->view->render("AddressController#put");
    }
    function delete($request){
        $this->view->render("AddressController#delete");
    }
    
}