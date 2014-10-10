<?php
App::uses('AppController', 'Controller');
/**
 * Stations Controller
 *
 * @property Station $Station
 * @property PaginatorComponent $Paginator
 */
class StationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');

/**
 * Models
 *
 * @var array
 */
  public $uses = array('Station','Network','Parameter');

/**
 * Paginate Settings
 *
 * @var array
 */
  public $paginate = array(
    'limit' => 10,
    'order' => array('name' => 'asc')
  );

/**
 * index method
 *
 * @return void
 */
	public function index() {
	  $this->Station->recursive = 0;
	  if (!isset($this->request->params['ext'])) {
  		$this->Paginator->settings = $this->paginate;	  
	  }
		$this->set('stations', $this->Paginator->paginate());
		//$this->set('_serialize', array('stations'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $network
 * @param string $name
 * @return void
 */
	public function view($network = null, $name = null) {
    $this->Station->recursive = 2;
    $station = $this->Station->find('first',array('conditions'=>array('network_name'=>$network,'name'=>$name)));
    if (!$station) {
			throw new NotFoundException(__('Invalid station'));
		}
		$this->set('station', $station);
		//$this->set('_serialize', array('station'));
	}

/**
 * search method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function search() {
    // Step 1 - Parse URL query variables
    $r_networks = $this->request->query('networks');
    $r_parameters = $this->request->query('parameters');
    $r_location = $this->request->query('location');
    $r_start_time = $this->request->query('start_time');
    $r_end_time = $this->request->query('end_time');
    $this->set(compact('r_networks','r_parameters','r_location','r_start_time','r_end_time'));
    
    // Step 2 - Validate Data and Specify Conditions
    $conditions = [];

    // Networks
	  if (($r_networks)  && strcasecmp($r_networks,'all') != 0) {
	    $networks = $this->Network->find('all',array('fields'=>array('name'),'conditions'=>array('name'=>explode(',',$r_networks))));
      $conditions['network_name'] = Hash::extract($networks, '{n}.Network.name');
	  }

    // Parameters
	  if (($r_parameters)  && strcasecmp($r_parameters,'all') != 0) {
	    $parameters = $this->Parameter->find('all',array('fields'=>array('id'),'conditions'=>array('name'=>explode(',',$r_parameters))));
      $conditions['Sensor.parameter_id'] = Hash::extract($parameters, '{n}.Parameter.id');
	  }

    // Location
    if ($r_location) {
      $loc = $this->_validateLocation($r_location);
    } else {
      $loc='';
    }

    if (is_array($loc)) {
      if ($loc['llon'] > $loc['ulon']) { 
        // Allow for searching over the International Date Line.
    	  $conditions["MBRContains( GeomFromText(?), location ) 
    	            OR MBRContains( GeomFromText(?), location )"] = array(
          "Polygon((" . $loc['llon'].' '.$loc['llat']. ','
                      . $loc['llon'].' '.$loc['ulat']. ','
                      . '180'.' '.$loc['ulat']. ','
                      . '180'.' '.$loc['llat']. ','
                      . $loc['llon'].' '.$loc['llat']. "))",
          "Polygon((" . '-180'.' '.$loc['llat']. ','
                      . '-180'.' '.$loc['ulat']. ','
                      . $loc['ulon'].' '.$loc['ulat']. ',' 
                      . $loc['ulon'].' '.$loc['llat']. ','
                      . '-180'.' '.$loc['llat']. "))"
    	  ) ;
      } else {
    	  $conditions["MBRContains( GeomFromText(?), location )"] = array(
    	    "Polygon((" . $loc['llon'].' '.$loc['llat']. ',' 
    	                . $loc['llon'].' '.$loc['ulat']. ','
    	                . $loc['ulon'].' '.$loc['ulat']. ','
    	                . $loc['ulon'].' '.$loc['llat']. ','
    	                . $loc['llon'].' '.$loc['llat']. "))"
        );
      }
    }

	  // Times, defaults to real-time 30-day window
	  if (strcasecmp($r_end_time,'now') == 0 || is_null($r_end_time)) {
  	  $end_time = time();
    } else {
  	  $_tss = $this->_readISO8601($r_end_time);
  	  if ($_tss) {
  		  $end_time = $_tss;
  		} else {
        throw new BadRequestException("Invalid end_time. Format should be 0000-00-00T00:00Z or 0000-00-00 or 'now' ");
      }
    }
    if (is_numeric($r_start_time) ) {
      $start_time = $end_time - $r_start_time*60*60*24;
    } elseif (is_null($r_start_time)) {
      $start_time = $end_time - 30 * 60*60*24; // 30 day default
    } else {
      $_tse = $this->_readISO8601($r_start_time);
      if ($_tse) {
        $start_time = $_tse;
      } else {
        throw new BadRequestException("Invalid start_time. Format should be 0000-00-00T00:00Z or 0000-00-00 or number of days before end_time.");
      }
    }
    if ($start_time > $end_time) {
      throw new BadRequestException("Error: start_time can not be greater than end_time.");
    }
    //if (($end_time-$start_time)/(60*60*24) > 366.5) {
    //  throw new BadRequestException("Error: Requested date range cannot exceed 1 (leap) year.");
    //}	  
    $conditions['start_time <='] = gmdate('Y-m-d H:i:s',$end_time);
    $conditions['end_time >='] = gmdate('Y-m-d H:i:s',$start_time);
    
    // Other settings
    $joins = array(
      array('table' => 'sensors',
        'alias' => 'Sensor',
        'type' => 'INNER',
        'conditions' => array(
          'Sensor.station_id = Station.id'
        )
      )
    );
    $group = array('Station.network_name','Station.name');
    
    // Step 3 - Query and output stations
	  $this->Station->recursive = 0;	  
    if (!isset($this->request->params['ext'])) {
      $this->paginate['conditions'] = $conditions;
      $this->paginate['joins'] = $joins;
      $this->paginate['group'] = $group;
  		$this->Paginator->settings = $this->paginate;	  
  	  $stations = $this->Paginator->paginate('Station');
	  } else {
	    $stations = $this->Station->find('all',array(
	      //'fields'=>array('id','date_time','value'),
	      'conditions'=>$conditions,
	      'joins'=>$joins,
	      'group'=>$group,
	      'order'=>array('name'=>'asc'),
      ));
	  }
		$this->set('stations', $stations);
		//$this->set('_serialize', array('stations'));
	}


/**
 * readISO8601
 * Adapted from NDBC SOS
 */
  private function _readISO8601($str) {
  	$_matches = array();
  	$_ts = null;
  	if (preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2}(\.\d{2})?)Z$/D',$str,$_matches) === 1) {
  		$_ts = gmmktime(intval($_matches[4]),intval($_matches[5]),round($_matches[6]),intval($_matches[2]),intval($_matches[3]),intval($_matches[1]));
  	} elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2})Z$/D',$str,$_matches) === 1) {
  		$_ts = gmmktime(intval($_matches[4]),intval($_matches[5]),0,intval($_matches[2]),intval($_matches[3]),intval($_matches[1]));
  	} elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/D',$str,$_matches) === 1) {
  		$_ts = gmmktime(0,0,0,intval($_matches[2]),intval($_matches[3]),intval($_matches[1]));
  	}
  	return $_ts;
  }  


/**
 * _validateLocation
 */
  private function _validateLocation($input) {
    if (preg_match('/^(-?\d+(\.\d+)?),(-?\d+(\.\d+)?),(-?\d+(\.\d+)?),(-?\d+(\.\d+)?)$/iD',$input,$_matches) == 1) {
      $out['llon'] = $_matches[1];
      $out['llat'] = $_matches[3];
      $out['ulon'] = $_matches[5];
      $out['ulat'] = $_matches[7];
  		if ($out['llat'] < -90 || $out['llat'] > 90) {
        throw new BadRequestException("Lower Latitude out of range (-90 to 90).");
  		}
  		if ($out['ulat'] < -90 || $out['ulat'] > 90) {
        throw new BadRequestException("Upper Latitude out of range (-90 to 90).");
  		}
  		if ($out['llon'] < -360 || $out['llon'] > 360) {
        throw new BadRequestException("Lower Longitude out of range (-360 to 360).");
  		}
  		if ($out['ulon'] < -360 || $out['ulon'] > 360) {
        throw new BadRequestException("Upper Longitude out of range (-360 to 360).");
  		}
  		if ($out['llat'] > $out['ulat']) {
        throw new BadRequestException("Lower Latitude cannot be greater than Upper Latitude.");
  		}
  		//if ($out['llon'] > $out['ulon']) {
      //  throw new BadRequestException("Lower Longitude cannot be greater than Upper Longitude.");
  		//}
  		if (($out['ulon'] - $out['llon']) > 360) {
        throw new BadRequestException("Longitude range must not exceed 360 degrees.");
  		}
  		return $out;
    } else {
      throw new BadRequestException("Bad location format.  Please specify as <lower long>,<lower lat>,<upper long>,<upper lat>");
    }
  }


}
