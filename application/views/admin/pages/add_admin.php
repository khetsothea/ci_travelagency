<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h3>Fill the form to add another admin:</h3>
<h4>
	<?=$this->session->flashdata('err_success');?>
</h4>		
<div class="col-md-6">
	<form action = "<?=base_url()?>admin/addadmin_pro" method="post" enctype="multipart/form-data">
		<h4>Full Name:</h4>
		<input type="text" name="full_name" placeholder="Full Name" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('fullname_err');?></h4></span>
		<hr>
		<h4>Once defined username cannot be modified later.</h4>
		<h4>Username:</h4>
		<input type="text" name="username" placeholder="Username" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('username_err');?></h4></span>	

		<h4>Password:</h4>
		<input type="password" name="password" placeholder="Password" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('password_err');?></h4></span>
		<h4>Confirm Password:</h4>
			<input type="password" name="confirm_password" placeholder="Confirm password" class="form form-control">
			<span><h4 style="color:red;"><?=$this->session->flashdata('confirmpassword_err');?></h4></span>
		<h4>Email</h3>
		<input type="email" name="email" placeholder="Email" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('email_err');?></h4></span>
		<h4>Image</h4>
		<input type="file" name="image">
		<br>
		<span><h4 style="color:red;"><?=$this->session->flashdata('usertype_err');?></h4></span>
		<h4 style="display:inline;">Usertype: </h4>
		<select name="usertype">
			<option value="">----</option>
			<option value="admin">admin</option>
		</select>
		<br>
		<br>
		<span><h4 style="color:red;"><?=$this->session->flashdata('status_err');?></h4></span>
		<h4 style="display:inline">Status: </h4>
		<select name="status">
			<option value="">----</option>
			<option value="1" class="active">active</option>
			<option value="0">Not-active</option>
		</select>
		<br>
		<br>
		<input type="submit" name="btnsubmit" value="Add user" class="btn btn-success">	
	</form>
</div>