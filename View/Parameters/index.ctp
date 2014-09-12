<div class="parameters index">
  <?php echo $this->Html->link('JSON Format', '/parameters.json', array('class'=>'btn btn-primary pull-right')); ?>
  
	<h2><?php echo __('Parameters'); ?></h2>
	<table class="table table-striped table-hover table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('units'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($parameters as $parameter): ?>
	<tr>
		<td><?php echo h($parameter['Parameter']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($parameter['Parameter']['name'], array('action' => 'view', $parameter['Parameter']['name'])); ?>&nbsp;</td>
		<td><?php echo h($parameter['Parameter']['category']); ?>&nbsp;</td>
		<td><?php echo h($parameter['Parameter']['description']); ?>&nbsp;</td>
		<td><?php echo h($parameter['Parameter']['units']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	<div class="paging">
    <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
	</div>
</div>
