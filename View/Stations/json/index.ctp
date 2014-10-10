<?php 
$geojson = array( 'type' => 'FeatureCollection', 'features' => array());
foreach ($stations as $station) {
  $marker = array(
    'type' => 'Feature',
    'properties' => array(
      'network' =>  $station['Station']['network_name'],
      'name' => $station['Station']['name'],
      'description' => $station['Station']['description'],
      'start_time' => $station['Station']['start_time'],
      'end_time' => $station['Station']['end_time'],
    ),
    "geometry" => array(
      'type' => 'Point',
      'coordinates' => array($station['Station']['longitude'],$station['Station']['latitude']),
    )
  );        
  array_push($geojson['features'], $marker);
}

if (version_compare(PHP_VERSION, '5.4.0', '>=') && Configure::read('debug')) {
  echo json_encode($geojson, JSON_PRETTY_PRINT);
} else {
  echo json_encode($geojson);
}