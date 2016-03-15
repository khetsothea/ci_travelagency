<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h3>Edit package form</h3>
<hr>
<h3><?=$this->session->flashdata('err_success');?></h3>
<form method="post" action="<?=base_url();?>action/editpackage_pro/<?=$package[0]['id'];?>" enctype="multipart/form-data">
<label for="title">Title:</label>
	<input type="text" name="title" placeholder="Package title" class="form-control" style="width:100%;" value="<?=$package[0]['title'];?>">
	<h4 style="color:red"><?=$this->session->flashdata('title_err');?></h4>
	<label for="desc">Package description:</label>
	<textarea name="desc" placeholder="Package description" class="form-control" rows="15" style="width:100%;"><?=$package[0]['description'];?></textarea>
	<h4 style="color:red"><?=$this->session->flashdata('desc_err');?></h4>
	<label for="added_by">Added by:</label>
	<input type="text" name="added_by" value="<?=$package[0]['added_by'];?>" class="form-control">
	<h4 style="color:red"><?=$this->session->flashdata('addedby_err');?></h4>
	<br>
	<img src="<?=base_url();?>uploads/package_image/<?=$package[0]['image'];?>" height="10%" width="25%">
	<br>
	<label for="image">Package image:</label>
	<input type="file" name="image">
	<h4 style="color:red"><?=$this->session->flashdata('upload_err');?></h4>
	<br>
	<?php if($package[0]['status']==1){$status = "available";} else{ $status = "not-available";} ?>
	<strong>Current value: <?=$status;?></strong>
	<br>
	<label for="status">Status:</label>
	<select name="status">
		<option>----</option>
		<option value="1">available</option>
		<option value="0">not-available</option>		
	</select>
	<h4 style="color:red"><?=$this->session->flashdata('status_err)');?></h4>
	<br><br>
	<input type="submit" value="Update" class="btn btn-success">
</form>