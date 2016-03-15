<?php 
if(!$this->session->userdata('userid')){
  redirect('site/index');
}
?>
<h3>Add Package:</h3>
<h4>
	<?=$this->session->flashdata('err_success');?>
</h4>		
<div class="col-md-6">
	<form action = "<?=base_url()?>action/addpackage_pro" method="post" enctype="multipart/form-data">
		<h4>Package title:</h4>
		<input type="text" name="title" placeholder="Package title" class="form form-control">
		<span><h4 style="color:red;"><?=$this->session->flashdata('title_err');?></h4></span>
		<hr>	
		<h4>Package description:</h4>
		<textarea name="description" rows="10" placeholder="Package description" class="form-control"></textarea>
		<span><h4 style="color:red;"><?=$this->session->flashdata('desc_err');?></h4></span>
		<h4>--Optional</h4>
		<h4>Related image:</h4>
		<input type="file" name="image">
		<span><h4 style="color:red;"><?=$this->session->flashdata('upload_err');?></h4></span>
		<br><br>
		<h4 style="display:inline;">Package Status:</h4>
		<select name="status">
			<option value="">----</option>
			<option value="1">active</option>
			<option value="0">not-active</option>
		</select>
		<br><br>
		<input type="submit" name="btnsubmit" value="Add package" class="btn btn-success">	
	</form>
</div>