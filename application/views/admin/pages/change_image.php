<h3>Change profile image</h3>
<hr>
<?php 
if($this->session->userdata('usertype') == "admin"){
	$img_path = "admin_image";
}
else{
	$img_path = "user_image";
}
?>
<h3><?=$this->session->flashdata('err_success');?></h3>
<img src="<?=base_url();?>uploads/<?=$img_path;?>/<?=$user[0]['image'];?>" width="50%" height="300px">
<br><br>
<form action="<?=base_url()?>action/changeimage_pro/<?=$this->session->userdata('userid');?>" method="post" enctype="multipart/form-data">
	<input type="file" name="image">
	<br>
	<input type="submit" class="btn btn-success" name="btnSubmit">
</form>