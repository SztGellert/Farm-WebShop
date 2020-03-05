<div class="orders index">
	<h2><?php echo __('Primary Products Webshop'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>

	</tr>
	</thead>
	<tbody>
	<tr>
		<p>This is a Primary Products Webshop.</p>
	</tbody>
	</table>
	<p>
	<?php echo $this->Html->image('fresh.jpg', array('alt' => 'Fresh Products')); ?>
	<div class="paging">
	
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Navigation '); ?></h3>
	<ul> 
	<li><?php echo $this->Html->link(__('Show Orders'), array('controller' => 'orders','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders','action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Show Daily Summarize'), array('controller' => 'orders','action' => 'daily')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
