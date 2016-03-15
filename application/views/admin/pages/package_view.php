<?php 
$id = $this->uri->segment(3);
if(empty($id)){
	redirect('action/package_list');
}
?>
<h3><?=$packages['0']['title'];?></h3>
<hr>
<img src="<?=base_url()?>uploads/package_image/<?=$packages['0']['image'];?>" height="300px" width="100%">
<p>
	<h4><?=$packages['0']['description'];?></h4>
</p>
<hr>
<h3>
	<a href="<?=base_url();?>action/package_list">Back to previous page</a>
</h3>
