<?php
App::uses('AppController', 'Controller');
/**
 * Data Controller
 *
 * @property Timeseries $Timeseries
 * @property PaginatorComponent $Paginator
 */
class TimeseriesController extends AppController {

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
  public $uses = array('Data','Station','Parameter','Sensor');

/**
 * Paginate Settings
 *
 * @var array
 */
  public $paginate = array(
    'limit' => 15,
    'order' => array('date_time' => 'asc')
  );

/**
 * index method
 *
 * @return void
 */
	public function index() {
	  // Parse URL query variables
    $r_network = $this->request->query('network');
    if (!$r_network) {
			throw new BadRequestException(__('Missing parameter: network'));
		}
    $r_station = $this->request->query('station');
    if (!$r_station) {
			throw new BadRequestException(__('Missing parameter: station'));
		}
    $r_parameter = $this->request->query('parameter');
    if (!$r_parameter) {
			throw new BadRequestException(__('Missing parameter: parameter'));
		}
    $start_time = $this->request->query('start_time');
    if (!$start_time) {
			throw new BadRequestException(__('Missing parameter: start_time'));
		}
    $end_time = $this->request->query('end_time');
    if (!$end_time) {
			throw new BadRequestException(__('Missing parameter: end_time'));
		}
    $r_type = $this->request->query('type');
		
		// Set request variables for view to use
    $this->set(compact('r_network','r_station','r_parameter','start_time','end_time'));

    
    // Look up Station, Parameter and Sensor
	  $station = $this->Station->find('first',array(
	    'recursive'=>0,
	    'fields'=>array('id','name','network_name'),
	    'conditions'=>array('network_name'=>$r_network,'name'=>$r_station)));
    if (!$station) {
			throw new NotFoundException(__('Station not found'));
		}
	  $parameter = $this->Parameter->find('first',array(
	    'recursive'=>0,
	    'fields'=>array('id','name','units'),
	    'conditions'=>array('name'=>$r_parameter)));
    if (!$parameter) {
			throw new NotFoundException(__('Parameter not found'));
		}
	  $sensor = $this->Sensor->find('first',array(
	    'recursive'=>-1,
	    'fields'=>array('id'),
	    'conditions'=>array('station_id'=>$station['Station']['id'],'parameter_id'=>$parameter['Parameter']['id'])));
    if (!$sensor) {
			throw new NotFoundException(__('This station/parameter combination is not valid'));
		}
	  
	  // Validate specified times
	  if (strcasecmp($end_time,'now') == 0) {
  	  $end_time_raw = time();
    } else {
  	  $_tss = $this->_readISO8601($end_time);
  	  if ($_tss) {
  		  $end_time_raw = $_tss;
  		} else {
        throw new BadRequestException("Invalid end_time. Format should be 0000-00-00T00:00Z or 0000-00-00 or 'now' ");
      }
    }
    if (is_numeric($start_time) ) {
      $start_time_raw = $end_time_raw - $start_time*60*60*24;
    } else {
      $_tse = $this->_readISO8601($start_time);
      if ($_tse) {
        $start_time_raw = $_tse;
      } else {
        throw new BadRequestException("Invalid start_time. Format should be 0000-00-00T00:00Z or 0000-00-00 or number of days before end_time.");
      }
    }
    if ($start_time_raw > $end_time_raw) {
      throw new BadRequestException("Error: start_time can not be greater than end_time.");
    }
    if (($end_time_raw-$start_time_raw)/(60*60*24) > 366.5) {
      throw new BadRequestException("Error: Requested date range cannot exceed 1 (leap) year.");
    }	  
	  
	  // Setup query conditions
	  $conditions = array('sensor_id'=>$sensor['Sensor']['id']);
	  if ($start_time) {
  	  $conditions['date_time >='] = gmdate('Y-m-d H:i:s',$start_time_raw);
	  }
	  if ($end_time) {
  	  $conditions['date_time <='] = gmdate('Y-m-d H:i:s',$end_time_raw);
	  }
	  $fields = array('id','date_time','value');
	  
	  switch ($r_type) {
  	  case 'month':
  	    $findtype = 'monthly_average';
  	    break;
  	  case 'day':
  	  	$findtype = 'daily_average';
  	  	break;
  	  default:
  	  	$findtype = 'all';
  	  	break;
	  }
	  	  
	  // Retrive data
    if (!isset($this->request->params['ext'])) {
      $this->paginate = array($findtype);
      $this->paginate['fields'] = $fields;
      $this->paginate['conditions'] = $conditions;
  		$this->Paginator->settings = $this->paginate;	  
  	  $data = $this->Paginator->paginate('Data');
	  } else {
	    $data = $this->Data->find($findtype,array(
	      'fields'=>$fields,
	      'conditions'=>$conditions,
	      'order'=>array('date_time'=>'asc')
      ));
	  }
		$this->set(compact('data','station','parameter'));
		$this->set('_serialize', 'data');
		
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


}
