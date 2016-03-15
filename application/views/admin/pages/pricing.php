<h2>Pricing table</h2>
<hr>
<h3><?=$this->session->flashdata('err_success');?></h3>
<table class="table table-hover table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>SN</th>
			<th>Package name</th>
			<th>No of persons</th>
			<th>Days</th>
			<th>Facilities</th>
			<th>Price</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
	<?php 
		$sn = 1;
		$i = 0;
		foreach ($pricing as $value) {
	?>
		<tr>
			<td><?=$sn?></td>
			<td><strong><?=$package[$i]['title']?></strong></td>
			<td><?=$value['persons']?> persons</td>
			<td><?=$value['days']?> days</td>
			<td><?=$value['facilities']?></td>
			<td>Rs. <?=$value['price']?></td>
			<td>
				<a href="<?=base_url();?>action/pricing_delete/<?=$value['id']?>" onclick="return confirm('Are you sure? Once deleted cannot be retrived.');">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php $sn++; $i++;} ?>
	</tbody>

</table>