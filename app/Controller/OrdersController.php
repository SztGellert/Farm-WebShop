<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 * @property virtualFields
 */

class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash','Stats');

/**
 * index method
 *
 * @return void
 */ public $uses = array('Order');
	public function index($numberOfOrders=null) {
		/* $this->Paginator->settings=array(
			'limit'=>10,
			'order'=>array('Order.id' => 'DESC')
		); */
		$orders=$this->Paginator->paginate();
		$all_orders=$this->Order->find('all');
		$total_amount=$this->Stats->summation($all_orders, 'amount');
		$total_price=$this->Stats->sumproducts($all_orders,'Order','Product');
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );
		$linetotal=$this->Stats->calculatelinetotals($orders,'Order','Product');
		$this->set(compact('total_amount','total_price','linetotal'));
/* 		debug($this->Order->find('all'));
 */		$this->Order->recursive = 0;
		 $this->set('orders', $orders);



	}

	public function daily($creation_date=null, $name=null) {
		$fruits= $this->Order->getfruits();
		$vegetables=$this->Order->getvegetables();
		$groceries=[];
		$groceries=array_merge($fruits,$vegetables);
		$this->set('groceries',$groceries);
		if (!$name && 
			$this->request &&
				is_array($this->request->data) &&
				array_key_exists('Product',$this->request->data) &&
				array_key_exists('name',$this->request->data['Product']))
		{
			$name = $this->request->data['Product']['name'];
			$name =$groceries[$name];

		}
		if (!$creation_date && 
			$this->request &&
				is_array($this->request->data) &&
				array_key_exists('Order',$this->request->data) &&
				array_key_exists('creation_date',$this->request->data['Order']))
		{
			$creation_date = $this->request->data['Order']['creation_date'];
		}
		
		$orders = $this->Order->find('all');
		$params = array(
			'conditions'=>array('DATE(Order.creation_date)' =>$creation_date, 'Product.name LIKE' =>$name."%"),
			'limit' => 20
		);
		$orders=$this->Order->find('all',$params);
		$this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate());
		$this->set('orders', $orders );
		$total_amount=$this->Stats->summation($orders, 'amount');
		$total_price=$this->Stats->sumproducts($orders,'Order','Product');
		$linetotal=$this->Stats->calculatelinetotals($orders,'Order','Product');
		$this->set(compact('total_amount','total_price','linetotal'));
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );
		$fruits=$this->Order->getfruits();
		$vegetables=$this->Order->getvegetables();
		$this->set(compact('fruits','vegetables'));
		$this->set('orders', $orders );


		}

	public function test() {
		$orders = $this->Order->find('all');
		$this->set('orders', $orders );

		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );

	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
		$this->set('order', $this->Order->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add($product_id= null) {
		if ($this->request->is('post')) {
			$this->Order->create();
			date_default_timezone_set("Europe/Budapest");
			$this->Order->saveField('creation_date', (date('Y-m-d H:i:s')));
			$this->Order->saveField('modification_date', (date('Y-m-d H:i:s')));
			if ($this->Order->save($this->request->data)) {
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The order could not be saved. Please, try again.'));
			}
		}
		$products = $this->Order->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				date_default_timezone_set("Europe/Budapest");
				$this->Order->saveField('modification_date', (date('Y-m-d H:i:s')));
				$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
		$products = $this->Order->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Order->delete($id)) {
			$this->Flash->success(__('The order has been deleted.'));
		} else {
			$this->Flash->error(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}