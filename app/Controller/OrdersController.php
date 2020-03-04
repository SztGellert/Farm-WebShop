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
		$orders = $this->Order->find('all');
/* 		$price=$this->Stats->doComplexOperation('Orders.amount','Product.price');
 */		$params = array('limit' => $numberOfOrders);
		$orders=$this->Order->find('all',$params);
		$this->Order->recursive = 0;
		$this->set('orders', $orders );
		$total_amount=$this->Stats->summation($orders, 'amount');
		debug($total_amount);
		$total_price=$this->Stats->sumproducts($orders,'Order','Product');
		$this->Stats->calculatelinetotals($orders,'Order','Product');
		debug($orders);
		debug($total_price);
		$this->set(compact('total_amount','total_price','price'));
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );
		$this->set('orders', $this->Paginator->paginate());

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
			'conditions'=>array('Order.creation_date LIKE' =>$creation_date."%", 'Product.name LIKE' =>$name."%"),
			'limit' => 20
		);
		$orders=$this->Order->find('all',$params);
		$this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate());
		$this->set('orders', $orders );
		$total_amount=Hash::extract($orders, '{n}.Order.amount');
		$total_amount=array_sum($total_amount);
		$this->loadModel('Product');
 		$total_price=Hash::extract($orders, '{n}.Product.price');
		$total_price=array_sum($total_price);
		$this->set(compact('total_amount','total_price'));
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );
		$fruits=$this->Order->getfruits();
		$vegetables=$this->Order->getvegetables();
		$this->set(compact('fruits','vegetables'));

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
		debug($this->referer());
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
		$params = array(
			'conditions'=>array('Product.product_id LIKE' =>$product_id."%"),
			'limit' => 20
		);
		if (!$product_id && 
		$this->request &&
			is_array($this->request->data) &&
			array_key_exists('Order',$this->request->data) &&
			array_key_exists('id',$this->request->data['Product']))
	{
		$id = $this->request->data['Product']['id'];
		$this->set('id', $id );

	}
		if ($this->request->is('post')) {
			$this->Order->create();
			date_default_timezone_set("Europe/Budapest");
			$this->Order->saveField('creation_date', (date('Y-m-d H:i:s')));
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
 * edit methodgl
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