<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h2><?php echo $this->session->flashdata('err_success'); ?></h2>
	<h3>User Details</h3>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>SN</th>
				<th>Full Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Usertype</th>
				<th>Status</th>
				<th>Image</th>
				<th>Edit/Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$sn = 1;
			$i = 0;
			foreach ($users as  $value) {
				$field[] =  $value;
			?>
			<tr>
				<td><?=$sn;?></td>
				<td><?=$field[$i]['full_name'];?></td>
				<td><?=$field[$i]['username'];?></td>
				<td><?=$field[$i]['email'];?></td>
				<td><?=$field[$i]['usertype'];?></td>
				<?php if($field[$i]['status']==1){ ?>
				<td><?="Active";?></td>
				<?php } else{ ?>
				<td><?="Not-active";?></td>
				<?php } ?>
				<td>
					<?php  
						$image = $field[$i]['image'];
						if(!empty($image)){
					?>
					<img src="<?=base_url()?>uploads/user_image/<?=$image;?>" height="80px" width="150px">
					<?php } else { ?>
						<h4>No related image found</h4>
					<?php } ?>
				</td>
				<td>
					<a href="<?=base_url()?>action/user_edit/<?=$field[$i]['id'];?>" onclick="return confirm('Do you want to edit?');" style="text-decoration:none;">
						<i class="glyphicon glyphicon-edit" style="width:40px;"></i>
					</a>
					<a href="<?=base_url()?>action/user_delete/<?=$field[$i]['id'];?>" onclick="return confirm('Do you want to delete? Once deleted cannot be retrieved later.');" style="text-decoration:none;">
					<i class="glyphicon glyphicon-trash" style="width:40px;"></i>
					</a>
				</td>
			</tr>
		<?php $i++; $sn++;  } ?>
		</tbody>
	</table>

	</div>