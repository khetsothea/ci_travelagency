<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#adminnav">
                <img src="<?=base_url();?>img/logo2.png" style="height:30px;width:30px;">
            </button>
            <a class="navbar-brand" href="<?=base_url()?>site/index"><img src="<?=base_url();?>img/logo2.png" style="height:25px;width:40px;display:inline;"> MyTravel Agency</a>
        </div>
        <div class="navbar-collapse collapse" id="adminnav">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Hi, <?=$this->session->userdata('username');?>
              <b class="caret"></b></a>
              <?php 
                 if($this->session->userdata('usertype') =="admin"){
                  $path = base_url()."uploads/admin_image/";
                  $table_name = "admin";
                 }
                 else{
                  $path = base_url()."uploads/user_image/";
                  $table_name = "users";
                 }
                 $cond = array('id'=>$this->session->userdata('userid'));
                 $data = $this->admin_model->selectby_cond($table_name,'image',$cond);
                 $img_name = $data[0]['image'];
              ?>
              <ul class="dropdown-menu nav navbar-default col-sm-4" id="admin">
                <div class="col-md-4 pull-left">
                 <img src="<?=$path.$img_name;?>" height="140px" width="140px;" style="float:left;">
                </div>
                <div class="col-md-6 pull-right">
                        <a href="<?=base_url()?>admin/setting" style="color:white;"> <i class="glyphicon glyphicon-cog"></i> Setting</a>
                      <br><hr>
                         <a href="<?=base_url()?>admin/profile" style="color:white;"> <i class="glyphicon glyphicon-user"></i> Profile</a>
                      <br><hr>
                        <a href="<?=base_url()?>admin/logout" style="color:white;"> <i class="glyphicon glyphicon-log-out"></i> Logout</a>
                      
                </div>
              </ul>
          </li>
          </ul>
        </div>
      </div>
</nav>