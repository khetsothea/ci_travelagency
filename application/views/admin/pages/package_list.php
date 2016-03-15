<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h2>List of all packages</h2>
<h4><?=$this->session->flashdata('err_success');?></h4>
<hr>
<div class="table-responsive">
	<tr>
		<td colspan="6">
			<ul class="pagination">
				<li class="pagination"><?=$pages;?></li>
			</ul>
		</td>
	</tr>
	<table class="table table-bordered table-responsive table-hover table-striped">
		<thead>
			<tr>
				<th>SN</th>
				<th>Package Title</th>
				<!-- <th>Description</th> -->
				<th>Action</th>
				<th>Status</th>
				<th>Image</th>
				<th>Edit/ Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$sn = 1;
			$i = 0;
			foreach($results as $val){
				$field[] = $val;
		?>
			<tr>
				<td><?=$sn?></td>
				<td><a href="<?=base_url();?>action/package_view/<?=$field[$i]['id'];?>"><?=$field[$i]['title'];?></a></td>
				<!-- <td><?=$field[$i]['description'];?></td> -->
				<td>
					<?php if($field[$i]['status']==0){ ?>
					<a href="<?=base_url();?>action/available/<?=$field[$i]['id'];?>">
						<button class="btn btn-primary">Available</button>
					</a>
					<?php } else { ?>
					<a href="<?=base_url();?>action/not_available/<?=$field[$i]['id'];?>">
						<button class="btn btn-danger">Not-available</button>
					</a>
					<?php } ?>
				</td>
				<?php  
					if($field[$i]['status']==1){ $status = "Available";} else{ 		$status = "Not-available";} 
				?>
				<td><?=$status;?></td>
				<?php 
					$image = $field[$i]['image'];
					if(!empty($image)){ 
				?>
				<td>
					<img src="<?=base_url()?>uploads/package_image/<?=$image?>" height="80px" width="140px">
				</td>
				<?php } else{ ?>
				<td>No related image found</td>
				<?php } ?>
				<td>
					<a href="<?=base_url()?>action/edit_package/<?=$field[$i]['id'];?>"><i class="glyphicon glyphicon-edit" style="width:30px" onclick="return confirm('Are you sure?');"></i></button></a>
					<a href="<?=base_url()?>action/delete_package/<?=$field[$i]['id'];?>" onclick="return confirm('Are you sure to delete? Once deleted cannot be undone.');"><i class="glyphicon glyphicon-trash" style="width:30px"></i></button></a>
				</td>
			</tr>
		<?php $sn++; $i++; } ?>
		</tbody>
	</table>		
</div>