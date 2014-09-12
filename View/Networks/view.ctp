<div class="networks view">
  <?php echo $this->Html->link('JSON Format', array('action' => 'view', $network['Network']['name'] . '.json'), array('class'=>'btn btn-primary pull-right')); ?>
  
  <h2>Network: <?php echo h($network['Network']['name']); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($network['Network']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($network['Network']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long Name'); ?></dt>
		<dd>
			<?php echo h($network['Network']['long_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($network['Network']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($network['Network']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($network['Network']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($network['Network']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
