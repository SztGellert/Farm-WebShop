<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<?php echo $this->Paginator->sort('product_id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('image'); ?></th>

				<th><?php echo $this->Paginator->sort('category'); ?></th>
				<th><?php echo $this->Paginator->sort('amount'); ?></th>
				<th><?php echo $this->Paginator->sort('price'); ?></th>
				<th><?php echo $this->Paginator->sort('creation_date'); ?></th>
				<th><?php echo $this->Paginator->sort('modification_date'); ?></th>


				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $available_fruits = array(); ?>
			<?php $available_vegetables = array(); ?>
			<?php $fruits_amount = 0; ?>
			<?php $vegetables_amount = 0; ?>
			<?php $fruits_income = 0; ?>
			<?php $vegetables_income = 0; ?>




			<?php foreach ($orders as $order) : ?>
				<tr>

					<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
					</td>
					<td><?php echo $this->Html->image($order['Product']['picture']); ?>&nbsp;</td>

					<td><?php echo h($order['Product']['category']); ?>
					<td><?php echo h($order['Order']['amount'] . " Kg"); ?>
					<td><?php echo h($order['linetotal'] . " Ft"); ?>
					</td>
					<?php if ($order['Product']['category'] == "fruit") {
						$available_fruits[] = $order['Product']['name'];
						$fruits_income += $order['linetotal'];
						$fruits_amount += $order['Order']['amount'];
					}
					if ($order['Product']['category'] == "vegetable") {
						$available_vegetables[] = $order['Product']['name'];
						$vegetables_income += $order['linetotal'];
						$vegetables_amount += $order['Order']['amount'];
					}
					?>

					<td><?php echo h($order['Order']['creation_date']); ?>&nbsp;</td>
					<td><?php echo h($order['Order']['modification_date']); ?>&nbsp;</td>


					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php $top_groceries = array();
			$i = 0; ?>
			<?php foreach ($orders as $order) : ?>
			<?php
				if (!array_key_exists($order['Product']['name'], $top_groceries)) {
					$top_groceries[$order['Product']['name']] = intval($order['Order']['amount'] * $order['Product']['price']);
				} else {
					$name_ = $order['Product']['name'];
					$top_groceries[$order['Product']['name']] += $order['Order']['amount'] * $order['Product']['price'];
				}
			endforeach;
			?>
		</tbody>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?> </p>
	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
	<?php $fruits_amount_percent = 0;
	$veggies_amout_percent = 0;
	$fruits_income_percent = 0;
	$vegetables_income_percent = 0;
	$fruits_amount_percent = ($fruits_amount / $total_amount * 100);
	$vegetables_amount_percent = ($vegetables_amount / $total_amount * 100);
	$fruits_income_percent = ($fruits_income / $total_price) * 100;
	$vegetables_income_percent = ($vegetables_income / $total_price) * 100; ?>

	<table>

		<tr>
			<th>&nbsp;<?php echo $this->Paginator->sort('Placement'); ?></th>
			<th>&nbsp;<?php echo $this->Paginator->sort('Product'); ?></th>
			<th><?php echo $this->Paginator->sort('income'); ?></th></br>
		</tr>
		</tbody>
		<tbody>
			<?php arsort($top_groceries);
			$i = 1; ?>
			<?php foreach ($top_groceries as $x => $x_value) { ?>
				<td><?php echo h($i . ". "); ?>&nbsp;</td>
				<td><?php echo ($x); ?></li>&nbsp;</td>
				<td><?php echo h($x_value . "\rFt");
					$i += 1; ?>&nbsp;</td>
				</tr>
			<?php }; ?>
	</table>
	<tbody>
		<table>

			<tr>
				<th>&nbsp;<?php echo $this->Paginator->sort('Category'); ?></th>
				<th>&nbsp;<?php echo $this->Paginator->sort('Amount'); ?></th>
				<th>&nbsp;<?php echo $this->Paginator->sort('Income'); ?></th>
				<th>&nbsp;<?php echo $this->Paginator->sort('Total Amount %'); ?></th>
				<th><?php echo $this->Paginator->sort('Total Income %'); ?></th>
			</tr>
	</tbody>
	</table>
	<tbody>
		<table>
			<td><?php echo h("Fruits"); ?></td>
			<td><?php echo h($fruits_amount . "\rKg"); ?></td>
			<td><?php echo h($fruits_income . "\rFt"); ?></td>

			<td><?php echo h(substr($fruits_amount_percent, 0, 5) . " %"); ?></td>
			<td><?php echo h(substr($fruits_income_percent, 0, 5) . " %"); ?></td>
			</tr>
			<td><?php echo h("Vegetables"); ?></td>
			<td><?php echo h($vegetables_amount . "\rKg"); ?></td>
			<td><?php echo h($vegetables_income . "\rFt"); ?></td>

			<td><?php echo h(substr($vegetables_amount_percent, 0, 5) . " %"); ?></td>
			<td><?php echo h(substr($vegetables_income_percent, 0, 5) . " %"); ?></td>
			<tr></tr>
			<td><b><?php echo h("Total"); ?></td>
			<td><b><?php echo h($total_amount . "\rKg"); ?></td>
			<td><b><?php echo h($total_price . "\rFt"); ?></td>

			<td><b><?php echo h("100" . " %"); ?></td>
			<td><b><?php echo h("100" . " %"); ?></b></td>
		</table></br>



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
		?>
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