<h3>
	<?php
		$this->session->flashdata('err_success');
		$result =  $this->session->userdata('search_result');
		$count = count($result[0]);
	?>
	<?=$count;?> results found.
	<?php 
		//var_dump($result);
		$i = 0;
		foreach ($result as $key=>$value) {
			$arr =  $value;
			
	?>
	<h4>Username:<?=$arr[$i]['username'];?></h4>
	<h4>Email:<?=$arr[$i]['email'];?></h4>
	<h4>Display Name:<?=$arr[$i]['display_name'];?></h4>
	<img src="<?=base_url()?>uploads/user_image/<?=$arr[$i]['image'];?>" style="height:150px;width:50%;">
	<hr>
	<?php $i++; } ?>
</h3>