<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input('price'); ?>
<?php echo $this->Form->end(__('Submit')); ?>
<?php foreach($products as $product) { ?>

    <?php echo($product); ?></br>
<?php }; ?>