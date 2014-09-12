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
		$this->set('_serialize', array('stations'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
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


}
