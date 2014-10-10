<div class="stations index">
  <?php echo $this->Html->link('CSV Format', array(
    'controller'=>'timeseries',
    'action'=>'index.csv',
    '?'=>array(
      'network' => $r_network,
      'station' => $r_station,
      'parameter' => $r_parameter,
      'start_time' => $start_time,
      'end_time' => $end_time,
    )), array('class'=>'btn btn-primary pull-right')); ?>


	<h2><?php echo strtoupper($station['Station']['network_name']) ?> 
	  <?php echo $station['Station']['name'] ?> 
	  <?php echo ucwords(str_replace('_', ' ', $parameter['Parameter']['name'])) ?> (<?php echo $parameter['Parameter']['units'] ?>)</h2>
	<table class="table table-striped table-hover table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('date_time'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($data as $datum): ?>
	<tr>
		<td><?php echo h($datum['Data']['date_time']); ?>&nbsp;</td>
		<td><?php echo h($datum['Data']['value']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	<div class="paging">
    <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
	</div>
</div>

