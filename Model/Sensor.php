<?php
App::uses('AppModel', 'Model');
/**
 * Sensor Model
 *
 * @property Station $Station
 */
class Sensor extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Station' => array(
			'className' => 'Station',
			'foreignKey' => 'station_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Parameter' => array(
			'className' => 'Parameter',
			'foreignKey' => 'parameter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
