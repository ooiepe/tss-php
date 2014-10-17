<?php
App::uses('AppModel', 'Model');
/**
 * Data Model
 *
 * @property Sensor $Sensor
 */
class Data extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'value';


/**
 * Virtual Fields
 *
 * @var array
 */
  public $virtualFields = array(
    //'avg' => 'AVG(value)'
  );

/**
 * findMethods
 *
 * @var array
 */
  public $findMethods = array('daily_average' =>  true, 'monthly_average' =>  true);

/**
 * _findDailyavg
 */
  protected function _findDaily_average($state, $query, $results = array()) {
    if ($state === 'before') {
      $this->virtualFields['value'] = 'ROUND(AVG(value),3)';
      $this->virtualFields['date_time'] = 'DATE_FORMAT(date_time,"%Y-%m-%d")';
      $this->virtualFields['count'] = 'COUNT(date_time)';
      $query['group'] = 'DATE_FORMAT(date_time,"%Y-%m-%d") HAVING COUNT(date_time) > 18';
      //$query['group'] = array('YEAR(date_time)','MONTH(date_time)','DAY(date_time)');
      return $query;
    }
    return $results;
  }


/**
 * _findMonthlyavg
 */
  protected function _findMonthly_average($state, $query, $results = array()) {
    if ($state === 'before') {
      $this->virtualFields['value'] = 'ROUND(AVG(value),3)';
      $this->virtualFields['date_time'] = 'DATE_FORMAT(date_time,"%Y-%m")';
      $this->virtualFields['count'] = 'COUNT(date_time)';
      $query['group'] = 'DATE_FORMAT(date_time,"%Y-%m") HAVING COUNT(date_time) > 18*15';
      //$query['group'] = array('YEAR(date_time)','MONTH(date_time)','DAY(date_time)');
      return $query;
    }
    return $results;
  }

}
