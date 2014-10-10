<?php 
$output['Station'] = array(
    "id"=>$station['Station']['id'],
    "network"=> $station['Station']['network_name'],
    "name"=> $station['Station']['name'],
    "description"=> $station['Station']['description'],
    "longitude"=> $station['Station']['longitude'],
    "latitude"=> $station['Station']['latitude'],
    "start_time"=> $station['Station']['start_time'],
    "end_time"=> $station['Station']['end_time'],
    "info_url"=> $station['Station']['info_url'],
    "image_url"=> $station['Station']['image_url'],
    "modified"=> $station['Station']['modified'],
    "parameters"=>array()
    );
foreach($station['Sensor'] as & $sensor) {
  $output['Station']['parameters'][] = array(
        //"id"=>$sensor['id'],
        "parameter_id"=>$sensor['parameter_id'],
        "name"=>$sensor['Parameter']['name'],
        "depth"=>$sensor['depth'],  
        "active"=>$sensor['active']
  );
}


if (version_compare(PHP_VERSION, '5.4.0', '>=') && Configure::read('debug')) {
  echo json_encode($output, JSON_PRETTY_PRINT);
} else {
  echo json_encode($output);
}