<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
$id = $this->uri->segment(3);
?>
<h3>User edit form:</h3>
<h4>
	<?=$this->session->flashdata('err_success');?>
</h4>		
<div class="col-md-6">
	<form action = "<?=base_url()?>action/edit_pro" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?=$id;?>">
		<input type="hidden" name="old_image" value="<?=$user[0]['image'];?>">
		<h4>Full Name:</h4>
		<input type="text" name="full_name" placeholder="Full Name" class="form form-control" value="<?=$user[0]['full_name'];?>">
		<span><h4 style="color:red;"><?=$this->session->flashdata('fullname_err');?></h4></span>	

		<h4>Username: <?=$user[0]['username'];?></h4>
		
		<h4>Password:</h4>
		<input type="password" name="password" placeholder="Password" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('password_err');?></h4></span>

		<h4>Confirm Password:</h4>
			<input type="password" name="confirm_password" placeholder="Confirm password" class="form form-control">
			<span><h4 style="color:red;"><?=$this->session->flashdata('confirmpassword_err');?></h4></span>

		<h4>Email</h3>
		<input type="email" name="email" placeholder="Email" class="form form-control" value="<?=$user[0]['email'];?>">
		<span><h4 style="color:red;"><?=$this->session->flashdata('email_err');?></h4></span>

		<span><h4 style="color:red;"><?=$this->session->flashdata('upload_err');?></h4></span>
		<img src="<?=base_url()?>uploads/user_image/<?=$user[0]['image'];?>" height="80px" width="250px;">
		<h4>Image</h4>
		<input type="file" name="image">
		<br>

		<span><h4 style="color:red;"><?=$this->session->flashdata('usertype_err');?></h4></span>
		<h4 style="display:inline;">Usertype: </h4>
		<h5>Current value: <?=$user[0]['usertype'];?></h5>
		<select name="usertype">
			<option value="">----</option>
			<option value="user">user</option>
			<option value="other">other</option>
		</select>

		<br>
		<br>
		<span><h4 style="color:red;"><?=$this->session->flashdata('status_err');?></h4></span>
		<h4 style="display:inline">Status: </h4>
		<?php if($user[0]['status']==1){$status = "Active";} else {$status = "Not-active";} ?>
		<h5>Current value: <?=$status;?></h5>
		<select name="status">
			<option value="">----</option>
			<option value="1">active</option>
			<option value="0">Not-active</option>
		</select>

		<br>
		<br>
		<input type="submit" name="btnsubmit" value="Update user" class="btn btn-success">	
	</form>
</div>