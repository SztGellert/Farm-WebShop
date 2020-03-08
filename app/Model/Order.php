<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Product $Product
 */


class Order extends AppModel {
	

	public function getDaysWithOrder()
	{
		$dates = array();
		$orders = $this->find('list',array('fields'=>array('id','creation_date')));
	
		foreach($orders as $orderId => $creation_date)
		{
		  $date = substr($creation_date,0,10);
			$dates[$date] = $date;
		}
	
	  
	return $dates;
}
public function getfruits()
	{
		return $this->getproductByCategory(('fruit'));
}

public function getvegetables()
	{
		return $this->getproductByCategory('vegetable');
}

public function getproductByCategory($categoryname)
	{
		$products = $this->Product->find('list',array(
			'conditions'=>array('Product.category'=>$categoryname)
		));
	  
	return $products;
}
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'decimal' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/* public function afterSave($created, $options=array(),$price_= null) {
	if($created) {
		
		$price=$this->Product->field('price');
		debug($price);
		debug($this->find('all'));

		debug($this->Products);
		die();
		$amount=$this->field('amount');
		$price_=$price*$amount;
		$this->saveField('cost', $price_);
	}
	return true;
}		
} */
}
