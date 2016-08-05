<div class="container">
	<h2 style="text-align:center;">Fill the form to book your tour package</h2>
	<hr>
	<h3><?php if($this->session->flashdata('msg')){echo $this->session->flashdata('msg')."<hr>";}?></h3>
	<div class="col-md-6 col-md-offset-3">
		<form action="<?=base_url()?>bookpackage_pro" method="post">
			<?php 
				$id = $this->session->userdata('package_id');
				if(empty($id)){ 
			?>
			<label for="package_name">Your package: </label>
			<select name="package_name">
			<?php
				$sn = 1;
				$i = 0;
				foreach($packages as $package){
					$data[] = $package;
			?>
				<option value="<?=$data[$i]['id']?>"><?=$data[$i]['title'];?></option>
			<?php $i++; $sn++; } }?>
			</select>
			<br>
			<label for="name">Your Name:</label>
			<input type="text" name="name" class="form-control" placeholder="Your full name" value="<?=set_value('name');?>">
			<span>
				<h3 style="color:red"><?=$this->session->flashdata('name_err');?></h3>
			</span>
			<label for="name">Email:</label>
			<input type="email" name="email" class="form-control" placeholder="Email" value="<?=set_value('email');?>">
			<span>
				<h3 style="color:red"><?=$this->session->flashdata('email_err');?></h3>
			</span>
			<label for="name">Phone Number:</label>
			<input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?=set_value('phone');?>">
			<label for="name">Country:</label>
			<input type="text" name="country" class="form-control" placeholder="Your country name" value="<?=set_value('country');?>">
			<span>
				<h3 style="color:red"><?=$this->session->flashdata('country_err');?></h3>
			</span>
			<label for="name">Queries if any:</label>
			<input type="text" name="queries" class="form-control" placeholder="Your queries if any" value="<?=set_value('queries');?>">
			<br>
			<input type="submit" name="btnSubmit" value="Book package" class="btn btn-success">
		</form>
	</div>
</div>
