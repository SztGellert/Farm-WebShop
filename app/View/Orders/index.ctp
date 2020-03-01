<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('creation_date'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
		<?php $total_price=0; ?>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['amount']." Kg"); ?>
		<?php $order_price=$order['Order']['amount']*$order['Product']['price']; ?>
		<td><?php echo h($order_price." Ft"); ?>
</td>

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

echo $this->Form->end('Daily');
?>

		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Show Daily Summarize'), array('action' => 'daily')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
