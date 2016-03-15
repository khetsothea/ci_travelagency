<h2>Change your setting here</h2>
<hr>
<?php $id = $this->session->userdata('userid');?>
<h3>
	<?php 
		echo $this->session->flashdata('err_success');
	?>
</h3>
<ol class="breadcrumb">
	<li><a href="<?=base_url();?>admin/change_password">Change Password</a></li>	
</ol>

<ol class="breadcrumb">
	<li><a href="<?=base_url();?>admin/change_displayname/<?=$this->session->userdata('userid');?>">Change Display name</a></li>

</ol><ol class="breadcrumb">
	<li><a href="<?=base_url();?>action/change_image/<?=$this->session->userdata('userid');?>">Change Image</a></li>	
</ol>

<ol class="breadcrumb">
	<li><a href="<?=base_url();?>action/change_status/<?=$this->session->userdata('userid');?>">Change Status</a></li>	
</ol>