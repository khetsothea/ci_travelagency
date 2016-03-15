<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h3>User Profile</h3>
<hr>
<div class="col-md-6">
	<table class="table table-striped table-hover">
		<tr>
			<td>Full Name:</td>
			<td><?=$data[0]['full_name']?></td>
		</tr>
		<tr>
			<td>Display Name:</td>
			<td><?=$data[0]['display_name']?></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><?=$data[0]['username']?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><?=$data[0]['email']?></td>
		</tr>
		<tr>	
			<td>Usertype:</td>
			<td><?=$data[0]['usertype']?></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><?php if($data[0]['status']==1){echo "Active";} else{ echo "Not-active";}?></td>
		</tr>
		<tr>
			<td>Image:</td>
			<td>
				<?php if($this->session->userdata['usertype']=="admin"){ ?> 
				<img src="<?=base_url();?>uploads/admin_image/<?=$data[0]['image']?>" height="20%" width="50%">
				<?php } else{ ?>
				 <img src="<?=base_url();?>uploads/user_image/<?=$data[0]['image']?>" height="20%" width="50%">
				 <?php } ?>
			</td>
		</tr>
	</table>
</div>
