<div class="orders view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($order['Product']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($order['Order']['amount']."\rkg"); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($order['Order']['amount']*$order['Product']['price']."\rFt"); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creation Date'); ?></dt>
		<dd>
			<?php echo h($order['Order']['creation_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modification Date'); ?></dt>
		<dd>
			<?php echo h($order['Order']['modification_date']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('E-mail:'); ?></dt>
		<dd>
			<?php echo h($order['Order']['email']); ?>
			&nbsp;
			</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
