<div class="parameters view">
  <?php echo $this->Html->link('JSON Format', array('action' => 'view', $parameter['Parameter']['name'] . '.json'), array('class'=>'btn btn-primary pull-right')); ?>
  
  <h2>Parameter: <?php echo h($parameter['Parameter']['name']); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Units'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['units']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CF MMI URL'); ?></dt>
		<dd>
			<?php echo $this->Html->link($parameter['Parameter']['cf_url'], $parameter['Parameter']['cf_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IOOS MMI URL'); ?></dt>
		<dd>
			<?php echo $this->Html->link($parameter['Parameter']['ioos_url'], $parameter['Parameter']['ioos_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($parameter['Parameter']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
