<div class="networks index">
  <?php echo $this->Html->link('JSON Format', '/networks.json', array('class'=>'btn btn-primary pull-right')); ?>

	<h2><?php echo __('Networks'); ?></h2>
	<table class="table table-striped table-hover table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('long_name'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($networks as $network): ?>
	<tr>
		<td><?php echo h($network['Network']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($network['Network']['name'], array('action' => 'view', $network['Network']['name'])); ?>&nbsp;</td>
		<td><?php echo h($network['Network']['long_name']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($network['Network']['url'], $network['Network']['url']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	<div class="paging">
    <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
	</div>
</div>
