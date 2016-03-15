<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h4><?php echo $this->session->flashdata('err_success'); ?></h4>
	<h3>Requested Packages</h3>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>SN</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Country</th>
				<th>Phone number</th>
				<th>Package description</th>
				<th>Response</th>
				<th>Status</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$sn = 1;
			$i = 0;
			foreach ($requested_packages as  $value) {
				$field[] =  $value;
		?>
			<tr>
				<td><?=$sn;?></td>
				<td><?=$field[$i]['customer_name'];?></td>
				<td><?=$field[$i]['email'];?></td>
				<td><?=$field[$i]['country'];?></td>
				<td><?=$field[$i]['phone'];?></td>
				<td><?=$field[$i]['query'];?></td>
				<td>
				<?php if($field[$i]['status'] == 0){ ?>
					<a href="<?=base_url()?>action/approve/<?=$field[$i]['id'];?>/ordered_package/<?=$this->uri->segment(2);?>" style="text-decoration:none;">
						<button class="btn btn-success">Approve</button>
					</a>
				<?php } else { ?>
					<a href="<?=base_url()?>action/stall/<?=$field[$i]['id'];?>/ordered_package/<?=$this->uri->segment(2);?>" style="text-decoration:none;">
						<button class="btn btn-info">Stall</button>
					</a>
				<?php } ?>
				</td>
				<?php if($field[$i]['status'] == 1){$status = "Approved";} else{ $status = "Stalled"; } ?>
				<td><?=$status;?></td>
				<td>
					<a href="<?=base_url()?>action/requestedpackage_delete/<?=$field[$i]['id'];?>" onclick="return confirm('Are you sure?');">
					<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
		<?php $i++; $sn++;  } ?>
		</tbody>
	</table>

	</div>