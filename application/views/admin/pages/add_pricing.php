<h2>Fill the form to add pricing table</h2>
<hr>
<h3><?=$this->session->flashdata('err_success');?></h3>
<div class="col-md-8">
	<form action="<?=base_url()?>action/addpricing_pro" method="post">
		<label for="price">Cost of tour:</label>
		<input type="text" name="price" placeholder="Total cost of the tour" class="form-control">
		<h4 style="color:red"><?=$this->session->flashdata('price_err');?></h4>
		<label for="no_of_perons">Number of persons for tour:</label>
		<input type="text" name="no_of_persons" placeholder="Total number of persons" class="form-control">
		<h4 style="color:red"><?=$this->session->flashdata('person_err');?></h4>
		<label for="days">Duration of tour:</label>
		<input type="text" name="days" placeholder="Duration of tour" class="form-control">
		<h4 style="color:red"><?=$this->session->flashdata('days_err');?></h4>
		<label for="facilities">Facilities:</label>
		<textarea name="facilities" rows="10" placeholder="Facilites to be provided in the tour" class="form-control"></textarea>
		<h4 style="color:red"><?=$this->session->flashdata('facilities_err');?></h4>
		<label for="package_id">Package name:</label>
		<select name="package_id">
			<?php foreach($package as $val){ ?>
			<option value="<?=$val['id']?>"><?=$val['title']?></option>
			<?php } ?>
		</select>
		<h4 style="color:red"><?=$this->session->flashdata('packageid_err');?></h4>
		<input type="submit" value="add" class="btn btn-success">
	</form>
</div>
