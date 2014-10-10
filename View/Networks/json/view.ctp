<?php 
$output['Network'] = array(
    "id"=>$network['Network']['id'],
    "name"=> $network['Network']['name'],
    "long_name"=> $network['Network']['long_name'],
    "description"=> $network['Network']['description'],
    "url"=> $network['Network']['url'],
    "modified"=> $network['Network']['modified'],
);

if (version_compare(PHP_VERSION, '5.4.0', '>=') && Configure::read('debug')) {
  echo json_encode($output, JSON_PRETTY_PRINT);
} else {
  echo json_encode($output);
}
