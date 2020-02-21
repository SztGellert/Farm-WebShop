
<th><?php echo ('Please choose a day! (example:2020-02-12)'); ?>
<?php #$days = array("2020-02-11","2020-02-12","2020-02-13","2020-02-19");?>
<?php $days = (array)null; ?>
<?php foreach ($orders as $order) {?>
	<?php #var_dump($order['Order']['creation_date']); ?>
	<?php array_push($days,substr(($order['Order']['creation_date']),0,10));?>
	<?php #print_r(array_values($days)); ?>
<?php } ?>
<?php $days=array_unique($days) ?>

<?php foreach ($days as $day): ?>
  	<option value=""><?php echo($day) ?></option>
	</select>

<?php  endforeach; ?>

<form method="post" action="<?php $name=str_replace(' ', '', "fname");?>">
  Day: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
	$name = $_POST['fname'];
	$name = trim($name);;
    if (empty($name)) {
        echo "Please type a valid date, listed above!";
    } else {
		echo $name;
		#<?php #if (in_array($name, $days)) {?>
		<div class="orders index">
		<h2><?php echo __('Orders'); ?></h2>
		<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('product_id'); ?></th>
		<th><?php echo $this->Paginator->sort('amount'); ?></th>
		<th><?php echo $this->Paginator->sort('creation_date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($orders as $order): ?>
			<?php if(preg_match("/{$name}/i", $order['Order']['creation_date'])) { ?>
				<tr>
				<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
				<td>
				<?php echo $this->Html->link($order['Product']['name'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
				</td>
				<td><?php echo h($order['Order']['amount']); ?>&nbsp;</td>
				<td><?php echo h($order['Order']['creation_date']); ?>&nbsp;</td>
				<td class="actions">
				<?php echo $this->Html->link(__('Daily'), array('action' => 'Daily', $order['Order']['id'])); ?>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
				</td>
				</tr>
				<?php 
			/* } if {
			echo "Day Not Found!"; */
			}
			?>
			<?php endforeach; ?>
			</tbody>
			</table>
			<p>
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
			<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
				<?php #foreach ($orders as $order): ?>
					<?php #endforeach; ?>
					
					<?php #  $date=$orders[$x][0]; ?>
					<td><?php #echo h($order['Order']['creation_date']);}?>&nbsp;</td>
					<?php #for ($x = 0; $x <= count($order['Order']); $x++) { ?> 
						<?php #}?>
						</ul>
						</div> <?php# }?>
	<?php	}
	}
	?>