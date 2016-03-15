<div class="col-md-6 col-md-offset-3">
	<h3 style="text-align:center;background:white;"><?=$this->session->flashdata('err');?></h3>
	<h3 style="text-align:center;background:white;"><?=$this->session->flashdata('err_success');?></h3>
</div>
<div class="col-md-4 col-md-offset-4">
	<div class="well">
		<h3 style="text-align:center;">Login form</h3>
		<form action = "<?=base_url()?>admin/login" method="post">
	        <input type="text" class="form form-control" name="username" placeholder="Username or Email">
	        <h4 style="color:red"><?=$this->session->flashdata('username_err');?></h4>
	        <br>
	        <input type="password" class="form-control" name="password" placeholder="password">
	        <h4 style="color:red"><?=$this->session->flashdata('password_err');?></h4>
	        <br>
	        <strong>Usertype:</strong>
	        <select name="usertype">
	            <option value="">----</option>
	            <option value="admin">admin</option>
	            <option value="user">user</option>
	        </select>
	        <h4 style="color:red"><?=$this->session->flashdata('usertype_err');?></h4>
	        <br><br>
	        <input type="submit" value="logIn" class="btn btn-primary" name="btnSubmit">                                
	    </form>
	</div>
	
</div>
<div style="clear:both;"></div>