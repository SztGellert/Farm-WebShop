
	/* $params = array(
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

	} */
	
	
	$total_amount=$this->Stats->summation($Definitelynotorders, 'amount');
		$total_price=$this->Stats->summation($Definitelynotorders, 'Product.price');
products/order
<div class="products form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Order Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
        echo $this->Form->input('amount');
		echo $_POST['ordersproductid'];
		echo $this->Form->input('E-mail');
		echo $_POST["E-mail"];
		echo $this->Form->input('Phone Number');
		#$_POST["Phone Number"];



	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Product.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
	</ul>
</div>
------------------------------------------------------------------------------

<?php
echo $this->Form->create('Post');

echo $this->Form->input('username');
echo $this->Form->input('password');

echo $this->Form->end('Add');
?>




<form action='fname' method="GET">
<select name='fname' onchange="this.form.submit()">
<option value="1">Option 1 </option>
<option value="2">Option 2 </option>
<option value="3">Option 3 </option>
<option value="4">Option 4 </option>
<option value="5">Option 5 </option>
</select>
</form>


echo $this->Form->select('creation_date', $dates);




new_hint
$felsorolas=$this->set('orders.', $this->Order->find('first','fields'));
		$this->set('orders', $this->Order->find('first', $felsorolas));
    
    
------------------   

LOGIKA A CONTROLLERBEN

$orders = $this->Order->find('all');

[
0 => Order => create_date => 2020-02-25 15:15:00
              product_id  => 15
     Product => id => 15
     					  name => Karalabe
                price => 234
1 => Order => create_date => 2020-02-24 15:15:00
              product_id  => 10
]

$dates = array();

foreach($orders as $order)
{
	$dates[] = substr($order['Order']['create_date'],0,10);
}

$dates = array_unique($dates);

$this->set('orders.', $orders );
$this->set('dates.', $dates );

view:

echo $this->Form->input('create_date', array('type'=>'select', 'options'=> $dates )); --> cakephp 1
echo $this->Form->select('create_date', $dates); --> cakephp 2

<select name="data[Order][create_date]" id="OrderType">
 <option value=""></option>
 <option value="M">Male</option>
 <option value="F">Female</option>
</select>


---------------------------------------

LOGIKA A MODELLBEN

order.php

class Order extends AppModel {

public function getDaysWithOrder()
{
	$dates = array()
	$orders = $this->find('list',array('fields'=>array('id','create_date')));

	foreach($orders as $orderId => $createDate)
	{
		$dates[] = substr($createDate,0,10);
	}

	$dates = array_unique($dates);
	debug($dates);
  return $dates;
}

}


orders_controller
$dates = $this->Order->getDaysWithOrder();
$this->set('dates.', $dates );


view
echo $this->Form->select('create_date', $dates); --> cakephp 2












---
gege's saves

<pre><?php print_r($orders); ?></pre>
$this->set('orders', $this->Order->find('all','fields'));
$this->set('orders', $this->Order->find('list'));
array_keys($this->YourModel->getColumnTypes());
$article = $articles->get($id);


$felsorolas=$this->set('orders', $this->Order->find('all','fields'));
		$this->set('orders', $this->Order->find('first', $felsorolas));


-----------------------------------------
hiszia gege
}this nyil order nyil x


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

---------------

DAILY TESZTVERZIO

<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
<!-- 			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
 -->		<th><?php echo $this->Paginator->sort('name'); ?></th>
 			<th><?php echo $this->Paginator->sort('image'); ?></th>

 			<th><?php echo $this->Paginator->sort('category'); ?></th>
 			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('creation_date'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php 	$available_fruits=array(); ?>
	<?php 	$available_vegetables=array(); ?>
	<?php 	$fruits_amount=0; ?>
	<?php 	$vegetables_amount=0; ?>
	<?php 	$fruits_income=0; ?>
	<?php 	$vegetables_income=0; ?>




 <!-- 	<?php debug($orders); ?>
 -->	<?php foreach ($orders as $order): ?>
	<tr>

		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
		</td>
		<td><?php echo $this->Html->image($order['Product']['picture']); ?>&nbsp;</td>

		<td><?php echo h($order['Product']['category']); ?>
		<td><?php echo h($order['Order']['amount']." Kg"); ?>
		<?php $order_price=$order['Order']['amount']*$order['Product']['price']; ?>
		<td><?php echo h($order_price." Ft"); ?>
</td>
		<?php if ($order['Product']['category']=="fruit") {
				$available_fruits[]=$order['Product']['name'];
				$fruits_income+=$order_price;
				$fruits_amount+=$order['Order']['amount'];

		}
			if ($order['Product']['category']=="vegetable") {
				$available_vegetables[]=$order['Product']['name'];
				$vegetables_income+=$order_price;
				$vegetables_amount+=$order['Order']['amount'];


			}
			?>

		<?php $total_price+=$order_price; 
		$toplist=array();
		$toplist[]=$order_price;
		?>
		
			
		
		<td><?php echo h($order['Order']['creation_date']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php $top_groceries=array();
	$i=0; ?>
	<?php foreach ($orders as $order): ?>
		<?php 
		if (!array_key_exists ( $order['Product']['name'] , $top_groceries)) {
			echo($order['Product']['name']);
	/* 		array_keys($top_groceries,$order['Product']['name']);
	*/		$top_groceries[$order['Product']['name']]=intval($order['Order']['amount']);

		

		}
		else {
			$name_=$order['Product']['name'];
			$top_groceries[$order['Product']['name']]+=$order['Order']['amount'];
		}
	endforeach;
	 ?>
	 <?php 
	 debug($top_groceries); 
	 echo(arsort($top_groceries))?>
	  <?php

foreach($top_groceries as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}
?> 
</tbody>
</table>
<p>
<?php $fruits_amount_percent=0; $veggies_amout_percent=0; $fruits_income_percent=0; $vegetables_income_percent=0;
$fruits_amount_percent=($fruits_amount/$total_amount*100); $vegetables_amount_percent=($vegetables_amount/$total_amount*100); 
$fruits_income_percent=($fruits_income/$total_price)*100; $vegetables_income_percent=($vegetables_income/$total_price)*100;?>

<!-- <th><b><?php echo "Top 3 Products"; ?>&nbsp;<?php echo($fruits_income. "\rFt \t( ".$fruits_income_percent."% )"); ?>&nbsp;</td></th></br>
 --><th><b><?php echo "Fruits income:"; ?>&nbsp;<?php echo($fruits_income. "\rFt \t( ".$fruits_income_percent."% )"); ?>&nbsp;</td></th></br>
<th><b><?php echo "Fruits amount:"; ?>&nbsp;<?php echo($fruits_amount. "\rKg \t( ".$fruits_amount_percent."% )"); ?>&nbsp;</td></th></br>
<th><b><?php echo "Vegetables income:"; ?>&nbsp;<?php echo($vegetables_income."\rFt \t( ".$vegetables_income_percent."% )"); ?>&nbsp;</td></th></br>
<th><b><?php echo "Vegetables amount:"; ?>&nbsp;<?php echo($vegetables_amount."\rKg \t( ".$vegetables_amount_percent."% )"); ?>&nbsp;</td></th></br>

<th><b><?php echo "Fruits:"; ?>&nbsp;<?php echo(implode(", ", array_unique($available_fruits))); ?>&nbsp;</td></th></br>
<th><b><?php echo "Veggies:"; ?>&nbsp;<?php echo(implode(", ",array_unique($available_vegetables))); ?>&nbsp;</td></th></br>


	<th><b><?php echo "Total Amount:"; ?>&nbsp;<?php echo h($total_amount." Kg"); ?>&nbsp;</td></th></br>
	
	<td><?php echo "Total Price:"; ?>&nbsp;<?php echo h($total_price." Ft"); ?>&nbsp;</td>
</th></br></br></b>
		<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	<?php
echo $this->Form->create();
echo $this->Form->select('creation_date', $dates);
echo $this->Form->end('Submit');
?>

	<?php
echo $this->Form->create();
echo $this->Form->select('creation_date', $dates);


/* echo $this->Form->end('Submit');
 */?>
<?php
echo $this->Form->select('Product.name', $groceries);


echo $this->Form->end('Submit');
?>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Show Daily Summary'), array('action' => 'daily')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>


