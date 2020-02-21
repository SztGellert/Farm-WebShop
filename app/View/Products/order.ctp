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
