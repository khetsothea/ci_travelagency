<h3>Change your display name here:</h3>
<hr>
<h4>
	<?=$this->session->flashdata('err_success'); ?>
</h4>
<div class="col-md-4">
	<form action="<?=base_url();?>admin/change_displayname_pro/<?=$this->session->userdata('userid');?>" method="post">
		<label for="old_password">Password:</label>
		<input type="password" name="password" placeholder="Password" class="form-control">
		<h5 style="color:red"><?=$this->session->flashdata('password_err');?></h5>
		<label for="new_displayname">New display name</label>
		<input type="text" name="new_displayname" placeholder="New display name" class="form-control">
		<h5 style="color:red"><?=$this->session->flashdata('displayname_err');?></h5>
		<br>
		<input type="submit" name="btnSubmit" value="Change" class="btn btn-success">
	</form>	
</div>
