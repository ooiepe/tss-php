<?php
App::uses('AppController', 'Controller');
/**
 * Networks Controller
 *
 * @property Network $Network
 * @property PaginatorComponent $Paginator
 */
class NetworksController extends AppController {

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
		$this->Network->recursive = 0;
	  if (!isset($this->request->params['ext'])) {
  		$this->Paginator->settings = $this->paginate;	  
	  }
		$this->set('networks', $this->Paginator->paginate());
		$this->set('_serialize', array('networks'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($name = null) {
    $network = $this->Network->findByName($name);
    if (!$network) {
			throw new NotFoundException(__('Invalid network'));
		}
		$this->set('network', $network);
		//$this->set('_serialize', array('network'));
	}

}
