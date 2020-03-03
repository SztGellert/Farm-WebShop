<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
<!-- 			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
 -->		<th><?php echo $this->Paginator->sort('name'); ?></th>
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




		<?php $total_price=0; ?>
<!-- 	<?php debug($orders); ?>
 -->	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
		</td>
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

		<?php $total_price+=$order_price; ?>
		
			
		
		<td><?php echo h($order['Order']['creation_date']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
<p>
<?php $fruits_amount_percent=0; $veggies_amout_percent=0; $fruits_income_percent=0; $vegetables_income_percent=0;
$fruits_amount_percent=($fruits_amount/$total_amount*100); $vegetables_amount_percent=($vegetables_amount/$total_amount*100); 
$fruits_income_percent=($fruits_income/$total_price)*100; $vegetables_income_percent=($vegetables_income/$total_price)*100;?>


<th><b><?php echo "Fruits income:"; ?>&nbsp;<?php echo($fruits_income. "\rFt \t( ".$fruits_income_percent."% )"); ?>&nbsp;</td></th></br>
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
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Show Daily Summarize'), array('action' => 'daily')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>