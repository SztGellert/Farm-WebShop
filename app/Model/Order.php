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
		$veggies = array();
		$products = $this->Product->find('list',array('fields'=>array('name','category')));
	
		$fruits=array();
		foreach($products as $name => $category)
		{
			if ($category=="fruit")
				$fruits[] = $name;
		}
	
	  
	return $fruits;
}

public function getvegetables()
	{
		$veggies = array();
		$products = $this->Product->find('list',array('fields'=>array('name','category')));
	
		$vegetables=array();
		foreach($products as $name => $category)
		{
			if ($category=="vegetable")
		 		$vegetables[] = $name;
		}
	
	  
	return $vegetables;
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
		
}
