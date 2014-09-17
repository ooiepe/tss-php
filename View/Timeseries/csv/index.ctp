<?php 
echo 'date_time,' . $parameter['Parameter']['name'] . "\n";
echo 'UTC,' . $parameter['Parameter']['units'] . "\n";
foreach ($data as $datum): 
  echo $datum['Data']['date_time'] . "," . $datum['Data']['value'] . "\n";
endforeach;
