<h3>Change your password here:</h3>
<hr>
<div class="col-md-4">
	<form action="<?=base_url();?>admin/changepassword_pro/<?=$this->session->userdata('userid');?>" method="post">
		<label for="old_password">Old password:</label>
		<input type="password" name="old_password" placeholder="Old password" class="form-control">
		<h5 style="color:red"><?=$this->session->flashdata('oldpassword_err');?></h5>
		<label for="new_password">New Password:</label>
		<input type="password" name="new_password" placeholder="New password" class="form-control">
		<h5 style="color:red"><?=$this->session->flashdata('newpassword_err');?></h5>
		<label for="confirm_password">Confirm Password</label>
		<input type="password" name="confirm_password" placeholder="Confirm password" class="form-control">
		<h5 style="color:red"><?=$this->session->flashdata('confirmpassword_err');?></h5>
		<br>
		<input type="submit" name="btnSubmit" value="Change" class="btn btn-success">
	</form>	
</div>
