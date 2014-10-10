<?php
App::uses('AppController', 'Controller');
/**
 * Parameters Controller
 *
 * @property Parameter $Parameter
 * @property PaginatorComponent $Paginator
 */
class ParametersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

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
	  $this->Parameter->recursive = 0;
	  if (!isset($this->request->params['ext'])) {
  		$this->Paginator->settings = $this->paginate;	  
	  }
		$this->set('parameters', $this->Paginator->paginate());
		$this->set('_serialize', array('parameters'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($name = null) {
    $parameter = $this->Parameter->findByName($name);
    if (!$parameter) {
			throw new NotFoundException(__('Invalid parameter'));
		}
		$this->set('parameter', $parameter);
		//$this->set('_serialize', array('parameter'));
	}


}
