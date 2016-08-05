<div class="container">
	<h2 style="text-align:center;">Fill the form to order your own tour package</h2>
	<hr>
	<h3 style="text-align:center;"><?php if($this->session->flashdata('msg')){echo $this->session->flashdata('msg')."<hr>";}?></h3>
	<div class="col-md-6 col-md-offset-3">
		<form action="<?=base_url()?>orderpackage_pro" method="post">
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
			<label for="name">Tour package description:</label>
			<textarea name="tour_desc" class="form-control" placeholder="Description of the tour package" rows="8" value="<?=set_value('desc');?>"></textarea>
			<label for="name">Queries if any:</label>
			<input type="text" name="queries" class="form-control" placeholder="Your queries if any" value="<?=set_value('queries');?>">
			<br>
			<input type="submit" name="btnSubmit" value="Add package" class="btn btn-success">
		</form>
	</div>
</div>
