hiszia gege


Products controller

	public function view($id = null) { --> ha nem adod meg az id-t, akkor null lesz az erteke
    debug($id);
		if (!$this->Product->exists($id)) {  --> https://api.cakephp.org/2.0/class-Model.html#_exists
			throw new NotFoundException(__('Invalid product'));
      vagy:
      $this->redirect('/products');
		}
    
    array = list
    [ 1, 2, 3 ]
    [ 'alma' => 10, 'banan' => 3888 ]
    
		$options = array('conditions' => array('Product.id' => $id));
    $product = $this->Product->find('first', $options); --> https://api.cakephp.org/2.0/class-Model.html#_find

	  Type of find operation (all / first / count / neighbors / list / threaded)
    
    --------
		$r = mysql_query("SELECT * FROM products left join orders on orders.product_id = products.id WHERE products.id = 13");
    while($productData = mysql_fetch_array($r))
    {
    	$product = array('Product'=>'name'=>$productData['name']);
    }
    ------
    debug($product);
    array( 'Product' => array( 'name' => 'krumpli',
    													 'price' => 399.0000
                               ))
                               
		$this->set('product', $product); --> App/View/Product/view.ctp -->  echo h($product['Product']['name']);
	}
  
  
  XXXController -> Model
  ProductsController -> Product
  $this->Product
  
  
  
  adatbázis - | model - controller - view | - browser - Gellert
                        ^(products_controller->view)   
  /products/view/13
  
  
  
  ---------------------------
  
  <?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class Product extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
=============================
class AppModel extends Model {
}
=============================
class Model extends CakeObject implements CakeEventListener {
...
public function exists($id = null) {
		if ($id === null) {
			$id = $this->getID();
		}

		if ($id === false) {
			return false;
		}

		if ($this->useTable === false) {
			return false;
		}

		return (bool)$this->find('count', array(
			'conditions' => array(
				$this->alias . '.' . $this->primaryKey => $id
			),
			'recursive' => -1,
			'callbacks' => false
		));
	}
...
}

https://www.php.net/manual/en/function.strtotime.php

date('Y-m-d',strtotime($idopont))
date('Y-m-d',strtotime("yesterday")) 2020-02-13
date('Y-m-d') 2020-02-14

<?php $index=0;?>
<label for="cars">Choose a day:</label>
<select id="cars" name="carlist" form="carform">
<?php $unique_dates=array(); ?>
<?php foreach ($orders as $order): ?>
 	<?php if (!in_array(substr($order['Order']['creation_date'],0,10), $unique_dates)) {
		 array_push($unique_dates, substr($order['Order']['creation_date'],0,10));
		}?>
	<option value=$creation_date><?php echo h($unique_dates[$index]); ?></option>
	<?php $index++; ?>
	<?php echo($unique_dates[0].$unique_dates[1]); ?>
	<?php debug($unique_dates); ?>
<?php endforeach; ?>
</select>

controller
$orders = $this->Order->find('all')
$dates = array();
foreach($orders as $order)
{
	$dates[] = $order['Order']['created_at'];
  array_push($dates,$order['Order']['created_at']);
}
$dates = array_unique($dates);
$this->set('dates',$dates)

view
echo $this->Form->input('date',array('type'=>'select','options'=>$dates))

<form action='orders/onday' POST>
<select>
 <option>2020-02-01</option>
 <option>2020-02-15</option>
 <option>2020-02-26</option>
</select>

<submit...>Keres</submit
</form>


orders controller
	public function onday() {
  
  	debug($this->request->data);
  	$created = ????
  
		$options = array('conditions' => array('Order.created_at LIKE' => $created));
    $orders = $this->Order->find('all', $options);
    SELECT * FROM orders WHERE created_at LIKE '2020-02-12%'
    $this->set('orders',$orders);
	}












