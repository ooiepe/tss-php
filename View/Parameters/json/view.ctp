<?php 
$output['Parameter'] = array(
    "id"=>$parameter['Parameter']['id'],
    "name"=> $parameter['Parameter']['name'],
    "category"=> $parameter['Parameter']['category'],
    "description"=> $parameter['Parameter']['description'],
    "units"=> $parameter['Parameter']['units'],
    "cf_url"=> $parameter['Parameter']['cf_url'],
    "ioos_url"=> $parameter['Parameter']['ioos_url'],
    "ioos_url"=> $parameter['Parameter']['ioos_url'],
    "modified"=> $parameter['Parameter']['modified'],
);

if (version_compare(PHP_VERSION, '5.4.0', '>=') && Configure::read('debug')) {
  echo json_encode($output, JSON_PRETTY_PRINT);
} else {
  echo json_encode($output);
}