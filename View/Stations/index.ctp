<div class="stations index">
  <?php echo $this->Html->link('JSON Format', '/stations.json', array('class'=>'btn btn-primary pull-right')); ?>

	<h2><?php echo __('Stations'); ?></h2>
	<table class="table table-striped table-hover table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('network_name'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th><?php echo $this->Paginator->sort('info_url'); ?></th>
			<th><?php echo $this->Paginator->sort('image_url'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stations as $station): ?>
	<tr>
		<td><?php echo h($station['Station']['id']); ?>&nbsp;</td>
		<td><?php echo h($station['Station']['network_name']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($station['Station']['name'], array('action' => 'view', $station['Station']['network_name'], $station['Station']['name'])); ?>&nbsp;</td>
		<td><?php echo h($station['Station']['description']); ?>&nbsp;</td>
		<td><?php echo h($station['Station']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($station['Station']['end_time']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link('<span class="glyphicon glyphicon-globe"></span>', $station['Station']['info_url'],array('escape' => false)); ?>&nbsp;</td>
		<td><?php echo $this->Html->link('<span class="glyphicon glyphicon-picture"></span>', $station['Station']['image_url'],array('escape' => false)); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	<div class="paging">
    <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
	</div>
</div>
