<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */ public $uses = array('Order');
	public function index($numberOfOrders=null) {
		$orders = $this->Order->find('all');
		$params = array(
			'conditions'=>array('Order.creation_date LIKE' =>"2020-02-27%"),
			'limit' => $numberOfOrders
		);
		$Definitelynotorders=$this->Order->find('all',$params);
		$this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate());
		$this->set('orders', $Definitelynotorders );
		$total_amount=Hash::extract($Definitelynotorders, '{n}.Order.amount');
		$total_amount=array_sum($total_amount);
		$this->loadModel('Product');
		$price = $this->Product->field('price');
/* 		$price=Hash::extract($Definitelynotorders, 'Product.price');
 */		$total_price=Hash::extract($Definitelynotorders, '{n}.Product.price');
		$total_price=array_sum($total_price);
		$amount = $this->Order->field('amount');
		$price=($price*$amount);

		$total=($total_amount+$total_price);
		$this->set(compact('total_amount','total_price','total','price','amount'));
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );

	}

	public function daily($creation_date=null) {
		pr($this->request);
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
			'conditions'=>array('Order.creation_date LIKE' =>$creation_date."%"),
			'limit' => 20
		);
		$Definitelynotorders=$this->Order->find('all',$params);
		$this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate());
		$this->set('orders', $Definitelynotorders );
		$total_amount=Hash::extract($Definitelynotorders, '{n}.Order.amount');
		$total_amount=array_sum($total_amount);
		$this->loadModel('Product');
		$price = $this->Product->field('price');
/* 		$price=Hash::extract($Definitelynotorders, 'Product.price');
 */		$total_price=Hash::extract($Definitelynotorders, '{n}.Product.price');
		$total_price=array_sum($total_price);
		$amount = $this->Order->field('amount');
		$price=($price*$amount);

		$total=($total_amount+$total_price);
		$this->set(compact('total_amount','total_price','total','price','amount'));
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );

		/* $orders = $this->Order->find('all');
		$this->set('orders', $orders );
		$dates = $this->Order->getDaysWithOrder();
		$this->set('dates', $dates );
		$myvar=$this->request->$orders['Order']['creation_date'];
		debug($myvar);
		$name = $_POST['creation_date'];
		$purchase = $_POST['submit'];
		echo($name.$purchase); */
		/* if ($this->request->is('post')) {
			$myvar=$this->request->data('Order.creation_date');
			echo $myvar;
		}
		$products = $this->Order->Product->find('list');
		$this->set(compact('products'));
			} */
		/* $myform=$this->Form->create(false);
		$this->set('myform',$myform); */
		/* $this->Order->recursive = 0;
		$this->set('orders', $this->Paginator->paginate()); */
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
	public function add($id = null) {
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