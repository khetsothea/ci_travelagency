<?php 
	if($user[0]['status']==1){
		$status = 'active';
	}
	else{
		$status = 'not-active';
	}
?>
<form action="<?=base_url()?>action/changestatus_pro/<?=$user[0]['id']?>" method="post">
	<h4>Current value: <?=$status;?></h4>
	<label for="status">Status:</label>
	<select name="status" id="status">
		<option value="1">active</option>
		<option value="0">not-active</option>
	</select>
	<input type="submit" class="btn btn-success" value="Change" name="btnSubmit">
</form>