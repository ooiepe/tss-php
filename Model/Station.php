<?php
App::uses('AppModel', 'Model');
/**
 * Station Model
 *
 * @property Sensor $Sensor
 */
class Station extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


/**
 * Virtual Fields
 *
 * @var array
 */
  public $virtualFields = array(
    'longitude' => 'X(location)',
    'latitude' => 'Y(location)'
  );


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Sensor' => array(
			'className' => 'Sensor',
			'foreignKey' => 'station_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
