<?php
// /example.php/address?id=0
$path = '';
if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
}

if ($path == '/address')
{
  $controller = new \Controller();
  $return = $controller->ex();
  echo $return;
}

class Controller
{
  var $addresses = [];

  function ex()
  {    
    if (!$this->rcd()){
        return json_encode(['error' => "No file found"]);
    }
    if(!isset($_GET['id'])) {
        return json_encode(['error' => "No id provided"]);
    }
    if(!isset($this->addresses[$_GET['id']])) {
        return json_encode(['error' => "Wrong id provided"]);
    }
    $id = $_GET['id'];
    $address = $this->addresses[$id];
    return json_encode($address);
  }

  function rcd()
  {
    if(!file_exists('example.csv')){
        return false;
    }
    $file = fopen('example.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $this->addresses[] = [
            'name' => $line[0],
            'phone' => $line[1],
            'street' => $line[2]
        ];
    }
    fclose($file);
    return true;
  }
}
?>
