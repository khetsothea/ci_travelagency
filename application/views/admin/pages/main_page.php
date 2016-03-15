<?php 
if(!$this->session->userdata('userid')){
  redirect('site/login_page');
}
?>
<h1 class="page-header">
 Admin Dashboard
</h1>

<div class="col-md-6 pull-left">
	<div class="panel panel-success">
		<div class="panel-heading"><h4>Recently added users</h4></div>
		<div class="panel-body">
			<ul class="list-group">
				<?php
					foreach($index_data[0][0][0] as $value){
				?>
				<li class="list-group-item list-group-item-success">
					<?="Username :- ".$value['username'];?>
				</li>
				<?php } ?>
				<li class="list-group-item">
					<a href="<?=base_url();?>admin/manage_users">see all users</a>
				</li>
			</ul>
		</div>
	</div>
</div>


<div class="col-md-6 pull-left">
	<div class="panel panel-primary">
		<div class="panel-heading"><h4>Recently added tour packages</h4></div>
		<div class="panel-body">
			<ul class="list-group">
				<?php
					foreach($index_data[0][1][0] as $value){
				?>
				<li class="list-group-item list-group-item-success">
					<?='Package name :- '.$value['title'];?>
				</li>
				<?php } ?>
				<li class="list-group-item">
					<a href="<?=base_url();?>action/package_list">see all tour packages</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="col-md-6 pull-left">
	<div class="panel panel-info">
		<div class="panel-heading"><h4>Recently requested packages</h4></div>
		<div class="panel-body">
			<ul class="list-group">
				<?php
					foreach($index_data[0][2][0] as $value){
				?>
				<li class="list-group-item list-group-item-success">
					<?='Requested by :- '.$value['customer_name'].' ('.$value['country'].')';?>
				</li>
				<?php } ?>
				<li class="list-group-item">
					<a href="<?=base_url();?>action/requested_packages">see all requested packages</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="col-md-6 pull-left">
	<div class="panel panel-warning">
		<div class="panel-heading"><h4>Recently booked packages</h4></div>
		<div class="panel-body">
			<ul class="list-group">
				<?php
					foreach($index_data[0][3][0] as $key=>$value){
				?>
				<li class="list-group-item list-group-item-success">
					Package name :- 
					<?php 
						$data = $this->db->get_where('packages',array('id'=>$value['packages_id']));
						$book_data = $data->result_array();
						echo $book_data[0]['title']." ";
						echo "(".$value['name'].")";
					?>
				</li>
				<?php } ?>
				<li class="list-group-item">
					<a href="<?=base_url();?>action/booked_packages">see all tour packages</a>
				</li>
			</ul>
		</div>
	</div>
</div>