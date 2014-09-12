<div class="stations view">
  <?php echo $this->Html->link('JSON Format', array('action' => 'view', $station['Station']['network_name'], $station['Station']['name'] . '.json'), array('class'=>'btn btn-primary pull-right')); ?>

  <h2>Station: <?php echo h($station['Station']['network_name']); ?> <?php echo h($station['Station']['name']); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($station['Station']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Network Name'); ?></dt>
		<dd>
			<?php echo h($station['Station']['network_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($station['Station']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($station['Station']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($station['Station']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($station['Station']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($station['Station']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($station['Station']['end_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info Url'); ?></dt>
		<dd>
			<?php echo $this->Html->link($station['Station']['info_url'], $station['Station']['info_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Url'); ?></dt>
		<dd>
			<?php echo $this->Html->link($station['Station']['image_url'], $station['Station']['image_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($station['Station']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($station['Station']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related col-md-6">
	<h3><?php echo __('Related Sensors'); ?></h3>
	<?php if (!empty($station['Sensor'])): ?>
	<table class="table table-striped table-hover table-condensed">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parameter'); ?></th>
		<th><?php echo __('Depth'); ?></th>
		<th><?php echo __('Active'); ?></th>
	</tr>
	<?php foreach ($station['Sensor'] as $sensor): ?>
		<tr>
			<td><?php echo $sensor['id']; ?></td>
			<td><?php echo $sensor['Parameter']['name']; ?></td>
			<td><?php echo $sensor['depth']; ?></td>
			<td><?php echo $sensor['active']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
  <?php endif; ?>
</div>
