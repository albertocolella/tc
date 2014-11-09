<?php

namespace TcRest\lib\adapters;

interface Adapter {
    public function insert($args);
    public function update($args);
    public function find($where=array(), $options=array());
    public function delete($args);    
}